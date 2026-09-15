const { chromium } = require('C:/Users/micke/AppData/Local/npm-cache/_npx/420ff84f11983ee5/node_modules/playwright');

const baseUrl = 'http://127.0.0.1/kencid%20website/';
const schoolUrl = `${baseUrl}?page_id=7&school=school-of-design`;
const viewports = [
  [1440, 1000],
  [1024, 900],
  [768, 1024],
  [390, 844],
];

(async () => {
  const browser = await chromium.launch({ headless: true });
  const context = await browser.newContext();
  const page = await context.newPage();
  const errors = [];

  page.on('pageerror', (error) => errors.push(`pageerror: ${error.message}`));
  page.on('console', (message) => {
    if (message.type() === 'error') errors.push(`console: ${message.text()}`);
  });

  for (const [width, height] of viewports) {
    await page.setViewportSize({ width, height });
    await page.goto(baseUrl, { waitUntil: 'networkidle' });
    await page.waitForTimeout(700);

    const fit = await page.evaluate(() => ({
      width: document.documentElement.clientWidth,
      scrollWidth: document.documentElement.scrollWidth,
    }));
    console.log(`homepage ${width}x${height}: overflow=${fit.scrollWidth > fit.width}`);

    if (width <= 1100) {
      await page.locator('.menu-toggle').click();
      await page.locator('.primary-nav__toggle').filter({ hasText: 'Schools' }).click();
    } else {
      await page.locator('.primary-nav__dropdown').filter({ has: page.locator('.primary-nav__toggle', { hasText: 'Schools' }) }).hover();
    }

    const firstSchoolLink = page.locator('.nav-panel--schools a').first();
    console.log(`menu ${width}x${height}: label="${(await firstSchoolLink.innerText()).trim()}" icon=${await firstSchoolLink.locator('svg').count() > 0}`);

    await page.goto(baseUrl, { waitUntil: 'networkidle' });
    await page.locator('.school-card').nth(1).click();
    await page.waitForLoadState('networkidle');
    console.log(`card ${width}x${height}: url=${page.url()} heading="${(await page.locator('h1').first().innerText()).trim()}" cards=${await page.locator('[data-course-card]').count()}`);

    if (width === 1440 || width === 390) {
      await page.screenshot({ path: `.qa-screenshots/school-flow/design-${width}-qa.png`, fullPage: false });
    }
  }

  await page.goto(schoolUrl, { waitUntil: 'networkidle' });
  const placeholder = await page.locator('#course-search').getAttribute('placeholder');
  const tags = await page.locator('[data-course-search]').allTextContents();
  await page.locator('#course-search').fill('Fashion');
  const filteredCount = await page.locator('[data-course-card]:visible').count();
  console.log(`school page: placeholder="${placeholder}" tags=${tags.slice(0, 5).join('|')} filteredCards=${filteredCount}`);

  if (errors.length) {
    console.error(errors.join('\n'));
    process.exitCode = 1;
  }

  await browser.close();
})().catch((error) => {
  console.error(error);
  process.exitCode = 1;
});
