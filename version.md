1st version - Creation Index.php & Folder Structure
2nd version - Adding of login.php and adding Auth Controller 
3rd version - Added Cloudflare Turnstile login protection for deployment, with a local development checkbox used until real Turnstile keys are configured. Keys are loaded from environment variables or a local ignored .env file.
4th version - Added 10-minute session inactivity timeout, session destruction on logout, expired session cookies, and no-store cache headers to prevent protected pages from being restored with the browser Back button.
5th version - Activated secure session and consent cookies, added HttpOnly/SameSite cookie handling, and replaced footer policy placeholders with Cookie Policy, Privacy Policy, Terms of Use, and Sitemap pages.
6th version - Replaced policy-page navigation with responsive in-page popups for Cookie Policy, Privacy Policy, Terms of Use, and Sitemap, with staff-focused legal and security context based on the provided reference.
7th version - Added professional Accept/Decline cookie consent with persistent consent choice and fixed policy popups with native-dialog and browser fallback support.
8th version - Added the initial MySQL users schema, phpMyAdmin setup script, securely hashed demo user account, individual user seeder, and database setup documentation.
9th version - Removed the public all-in-one database setup and demo-user seed to prevent a known account from being deployed accidentally; kept the reusable schema migration and documented local database setup guidance.
10th version - Added the complete ordered database foundation for users, roles, permissions, agriculture, fisheries, livestock, permits, insurance, pricing, notifications, audit logs, reference seeders, and reporting views; validated the full import against local MariaDB.
11th version - Expanded database ignore rules for local database folders, exports, dumps, and compressed local SQL files while keeping public migrations, seeders, and views trackable.
12th version - Connected the login form to MariaDB with prepared statements, password hash verification, CSRF validation, authenticated session state, last-login tracking, database configuration, and post-login redirect handling.
13th version - Finalized the database-backed login integration, cleared editor diagnostics for dynamically loaded security classes, and validated the demo login through the live XAMPP site.
14th version - Refactored the completed authentication path to use injected OOP services and controllers, including database access, password hashing, input sanitization, CSRF validation, Turnstile verification, and login request handling.
15th version - Added separate local administrator and personnel demo accounts, role-based dashboard redirects, server-side role middleware, and isolated admin/personnel dashboard access.
16th version - Added the protected personnel navigation and data-entry monitoring workflows for farmers, fishery catch, livestock, vegetables, real-time prices, and generated monitoring reports.
17th version - Replaced the personnel landing page with a data-driven analytics dashboard containing KPI summaries, price and catch trends, livestock and barangay comparisons, and latest price activity.
18th version - Moved personnel navigation to a responsive left sidebar and centralized the personnel sign-out action in a shared top header across all personnel pages.
19th version - Added a responsive collapsible personnel sidebar with mobile overlay, outside-click and Escape handling, desktop content/footer offsets, and resize-safe navigation behavior to prevent overlap.
20th version - Added a unified personnel sidebar toggle for desktop and mobile, allowing the navigation to be hidden or restored while automatically reclaiming or reserving header, content, and footer space.
21st version - Fixed desktop sidebar hiding by overriding the responsive display utility when the navigation is collapsed.
22nd version - Raised the personnel header above the mobile sidebar overlay so the same toggle button can both open and close the navigation without being blocked.
23rd version - Moved the primary personnel navigation toggle inside the sidebar and added a small header reopen control for restoring navigation after it is hidden.
24th version - Updated the application asset cache version so browsers load the corrected in-sidebar navigation toggle behavior.
25th version - Fixed mobile drawer layering and resize state so the in-sidebar toggle remains clickable and the overlay stays synchronized across desktop and mobile transitions.
26th version - Constrained the personnel shell to the viewport width, prevented horizontal swipe overflow, and corrected header, content, and footer sizing beside the fixed sidebar.
27th version - Removed the remaining right-side layout gap, centered personnel header titles, and moved the hidden-sidebar reopen control to the left edge.
28th version - Reserved responsive header space for personnel actions so centered titles cannot overlap the user identity or sign-out controls.
29th version - Fixed hidden-sidebar viewport sizing specificity, removed the remaining right-side white strip, and tightened responsive title space around header actions.
30th version - Moved the hidden-sidebar reopen control outside the right header action group so it stays fixed on the left edge as intended.
31st version - Increased responsive title clearance so centered personnel titles remain separated from the account and sign-out controls.
32nd version - Split personnel header title sizing by tablet and desktop breakpoints so responsive titles remain readable at medium widths.
33rd version - Restored vertical page scrolling while the personnel navigation drawer is open, while continuing to prevent horizontal overflow.
34th version - Added the personnel insurance entry module with policy tracking, coverage fields, active records display, and navigation integration for the agriculture and fisheries insurance workflows.
35th version - Added local insurance sample SQL data and tightened database ignore rules so private MariaDB import files stay out of Git while keeping the project schema and import structure intact.
36th version - Added Fishery Active and Inactive Fisher Folk sub-navigation, RSBSA and registration fields, fisherfolk registry listings, a Fishing Boat Insurance Application data-entry form based on the provided reference, printable application styling, application storage, and preserved catch monitoring.
37th version - Moved the Fishery Active, Inactive, Application, and Catch Monitoring tabs into the expandable main personnel sidebar navigation and synchronized their active states.
38th version - Updated each Fishery tab with its own page title, header subtitle, description, and section context for Active Fisher Folk, Inactive Fisher Folk, Application, and Catch Monitoring.
39th version - Connected Fishery applications to searchable Active and Inactive Fisher Folk registries, expanded registry tables with application-form context, and completed the printable form sections for attachments, applicant signature, account-officer review, and dates.
40th version - Separated Fishery into dedicated OOP FisheryController, FisheryService, and FisheryRepository classes with injected dependencies, repository-owned SQL and transactions, and page-level delegation through the controller.
41st version - Moved Fishery sub-navigation links, valid-section handling, and tab metadata into FisheryController so the main sidebar and Fishery page use one backend-owned definition.
42nd version - Fixed the Active and Inactive Fish Folk registry PDO HY093 error by assigning unique search parameters to each searchable column.
43rd version - Fixed Fishery sub-nav context being overwritten as Catch Monitoring by renaming the sidebar loop variable that collided with the page's selected section.
44th version - Reworked the Fishery Application screen into an A4 portrait paper-form layout with underline fields, print-only sizing, hidden portal navigation, and browser PDF-ready output matching the provided reference form.
45th version - Matched the Fishery Application print template more closely to the provided form with centered agency header hierarchy, compact ruled rows, square checkbox/radio options for applicant and boat choices, and preserved backend field submission.
46th version - Added a temporary CSRF-protected Fishery delete workflow for Active and Inactive Fisher Folk, deleting related applications, boats, and catch records transactionally while preserving the selected tab.
