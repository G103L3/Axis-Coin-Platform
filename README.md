#Axis Coin Platform
##Description

Axis Coin was a demo project created for university purposes. It consists of a web platform developed using the latest technologies, such as Bootstrap, HTML5, and CSS3, which allows users to access the system, verify their documents, and buy and sell a virtual token.

The virtual user accounts are stored in a MySQL database, along with the user's status (active, to be verified, suspended) and related data. The platform also features a real-time notification system, implemented without the use of pre-existing frameworks or libraries.

##Registration, Login, and Document Verification

The platform enables user registration, login, and document verification. Users can create an account by providing their personal information, which is then subjected to both client-side and server-side validation to ensure the data's integrity. Once registered, users can log in to the system using their credentials.

To verify their identity, users are required to upload their documents, such as a national ID or passport. The platform implements a comprehensive document verification process, checking the validity and authenticity of the uploaded documents before activating the user's account.

##Security Measures

All PHP scripts that interact with user input (GET, POST methods) implement data sanitization to prevent SQL injections. Additionally, they verify the request type (POST or GET) to ensure it matches the expected type.

Forms incorporate both client-side and server-side validation. This ensures a robust validation process, displaying specific error messages for individual fields or more general errors like connection issues or database insertion errors.


A .htaccess file is included to disable the display of PHP errors and warnings on the server, implement a URL rewriting engine to remove .php or .html extensions from URLs for a cleaner appearance, and redirect non-existent pages to a custom 404 error page.

##Accessibility Testing

The project has been tested for accessibility using the Mozilla Firefox Accessibility Inspector. ARIA tags are implemented to enhance accessibility for screen readers, and alt attributes are used for images to provide textual descriptions. Additionally, role attributes are used where necessary to improve the semantic meaning of elements.

##Browser Compatibility

The project has been thoroughly tested on the two most popular browsers in Malta (Chrome, Edge) and Mozilla Firefox, following browser market share statistics (https://gs.statcounter.com/). As Safari is not commonly used in Malta due to the low prevalence of Macs, testing was not conducted on this browser.

##Responsive Design

The project employs a responsive design approach, utilising generic classes like flex-row and flex-col for layout purposes. This ensures the website adapts seamlessly to different screen sizes and devices, providing an optimal user experience across various platforms.

##Caching Optimization

The system uses caching techniques designed for each individual piece of content on the site; each image, script, or digital content has different caching times. Furthermore, as there are no personal images of each piece of content, caching is allowed at the CDN or proxy level.

##Contributors

 - Gioele Giunta (G103L3)
