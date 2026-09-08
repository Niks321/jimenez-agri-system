1st version - Creation Index.php & Folder Structure
2nd version - Adding of login.php and adding Auth Controller 
3rd version - Added Cloudflare Turnstile login protection for deployment, with a local development checkbox used until real Turnstile keys are configured. Keys are loaded from environment variables or a local ignored .env file.
4th version - Added 10-minute session inactivity timeout, session destruction on logout, expired session cookies, and no-store cache headers to prevent protected pages from being restored with the browser Back button.
5th version - Activated secure session and consent cookies, added HttpOnly/SameSite cookie handling, and replaced footer policy placeholders with Cookie Policy, Privacy Policy, Terms of Use, and Sitemap pages.
6th version - Replaced policy-page navigation with responsive in-page popups for Cookie Policy, Privacy Policy, Terms of Use, and Sitemap, with staff-focused legal and security context based on the provided reference.
7th version - Added professional Accept/Decline cookie consent with persistent consent choice and fixed policy popups with native-dialog and browser fallback support.