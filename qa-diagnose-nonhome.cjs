const { chromium } = require('C:/Users/micke/AppData/Local/npm-cache/_npx/e6ff44ce4d342acd/node_modules/@playwright/test');

const baseUrl = 'http://127.0.0.1/kencid%20website/';
const routes = [
  'about-us/',
  'programs/',
  'projects/',
  'admissions/',
  'events/',
  'our-team/',
  'partners/',
  'contact/',
  'student-life/',
  'apply-now/',
  'programs/?course=interior-design',
];
const viewports = [
  { width: 1440, height: 1000 },
  { width: 390, height: 844 },
];

(async () => {
  const browser = await chromium.launch({ headless: true });
  const page = await browser.newPage();
  const errors = [];

  page.on('pageerror', (error) => errors.push(`pageerror: ${error.message}`));
  page.on('console', (message) => {
    if (message.type() === 'error') errors.push(`console: ${message.text()}`);
  });
  page.on('requestfailed', (request) => errors.push(`requestfailed: ${request.url()} ${request.failure()?.errorText || ''}`));

  for (const viewport of viewports) {
    await page.setViewportSize(viewport);
    for (const route of routes) {
      const response = await page.goto(`${baseUrl}${route}`, { waitUntil: 'domcontentloaded' });
      await page.waitForTimeout(500);
      const result = await page.evaluate(() => {
        const hero = document.querySelector('.page-hero, .course-detail-hero, .apply-hero');
        const heading = hero?.querySelector('h1');
        const heroRect = hero?.getBoundingClientRect();
        const headingRect = heading?.getBoundingClientRect();
        const images = [...document.images].map((img) => ({
          src: img.currentSrc || img.src,
          complete: img.complete,
          naturalWidth: img.naturalWidth,
          naturalHeight: img.naturalHeight,
        }));
        return {
          title: document.title,
          h1: heading?.textContent.trim() || document.querySelector('h1')?.textContent.trim(),
          heroClass: hero?.className || null,
          heroBackground: hero ? getComputedStyle(hero).backgroundImage : null,
          heroHeight: heroRect ? Math.round(heroRect.height) : null,
          headingBottomGap: heroRect && headingRect ? Math.round(heroRect.bottom - headingRect.bottom) : null,
          heroParagraphs: hero ? hero.querySelectorAll('p').length : null,
          bodyClass: document.body.className,
          clientWidth: document.documentElement.clientWidth,
          scrollWidth: document.documentElement.scrollWidth,
          brokenImages: images.filter((image) => image.complete && image.naturalWidth === 0).map((image) => image.src),
        };
      });
      console.log(JSON.stringify({ route, viewport, status: response?.status(), ...result }));
      const screenshotName = route.replace(/[^a-z0-9]+/gi, '-').replace(/^-|-$/g, '');
      await page.screenshot({ path: `.qa-screenshots/nonhome-diagnosis/${screenshotName}-${viewport.width}.png`, fullPage: false });
    }
  }

  console.log(JSON.stringify({ errors }));
  await browser.close();
})().catch((error) => {
  console.error(error);
  process.exitCode = 1;
});
