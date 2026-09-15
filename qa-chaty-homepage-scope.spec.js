const { test, expect } = require('C:/Users/micke/AppData/Local/npm-cache/_npx/e6ff44ce4d342acd/node_modules/@playwright/test');

const baseUrl = 'http://127.0.0.1/kencid%20website/';
const viewports = [
  [1440, 1000],
  [1024, 900],
  [768, 1024],
  [390, 844],
];

async function chatySvgStyles(page) {
  return page.locator('.chaty-widget svg').evaluateAll((svgs) => svgs.flatMap((svg) => [svg, ...svg.querySelectorAll('*')]).map((node) => ({
    stroke: getComputedStyle(node).stroke,
    strokeWidth: getComputedStyle(node).strokeWidth,
  })));
}

test('Chaty outline fix is scoped to the homepage', async ({ page }) => {
  const errors = [];
  page.on('pageerror', (error) => errors.push(error.message));
  page.on('console', (message) => {
    if (message.type() === 'error') errors.push(message.text());
  });

  for (const [width, height] of viewports) {
    await page.setViewportSize({ width, height });
    await page.goto(baseUrl, { waitUntil: 'networkidle' });
    await page.waitForTimeout(1200);

    expect(await page.locator('body').evaluate((body) => body.classList.contains('home'))).toBeTruthy();
    const styles = await chatySvgStyles(page);
    expect(styles.length).toBeGreaterThan(0);
    expect(styles.every((style) => style.stroke === 'none' && style.strokeWidth === '0px')).toBeTruthy();

    const fit = await page.evaluate(() => ({
      clientWidth: document.documentElement.clientWidth,
      scrollWidth: document.documentElement.scrollWidth,
    }));
    expect(fit.scrollWidth).toBe(fit.clientWidth);
    await page.screenshot({ path: `.qa-screenshots/chaty-homepage-${width}.png`, fullPage: false });
  }

  await page.goto(`${baseUrl}about-us/`, { waitUntil: 'networkidle' });
  await page.waitForTimeout(1200);
  expect(await page.locator('body').evaluate((body) => body.classList.contains('home'))).toBeFalsy();
  const nonHomepageStyles = await chatySvgStyles(page);
  expect(nonHomepageStyles.some((style) => style.stroke !== 'none' || style.strokeWidth !== '0px')).toBeTruthy();
  expect(errors).toEqual([]);
});
