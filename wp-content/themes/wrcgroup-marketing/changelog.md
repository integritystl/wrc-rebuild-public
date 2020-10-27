# WRC-Marketing-WPEngine 
Name: WRC Marketing WordPress Theme
Description: Theme for the marketing site.
Developer: Integrity St. Louis


Note: Changelog started 9/3/2019 after theme has been in productin for a few years. This is document is to capture theme changes moving forward. 

Usage: Create an entry with ## Verion X.X.X - update the theme version in the style.css file or whatever generates the main style file. Include date and developer under this heading.
Add changes with ### and appropriate label.

## Version 1.1.4
Date: 2/26/2020
Developer: Norman Huelsman

### Update
This update removes the second modal screen on 1st auto bill pay popup
- modal-company.php remove the call to the modal-form.php file and hard code urls to payment gateways for the 1st auto options
- scripts.js comment out click event to bring up modal-form
- update modal.scss

## Version 1.1.3
Date: 2/26/2020
Developer: Norman Huelsman

- Added news full width template and 2 col
- Swapped logos
- CSS hid the banner for announcments

## Version 1.1.3
Date: 2/26/2020
Developer: Norman Huelsman

### Update
- functions.php update jQuery version to 3.4.1, add function to disable forms autocomplete

## Version 1.1.2
Date: 2/26/2020
Developer: Norman Huelsman

### Update
- header.php show the wire link to all users
- add twitter and facebook icons to footer
- only display archive links if more than 4 wire items exist

## Version 1.1.1
Date: 2/13/2020
Developer: Norman Huelsman

## Update
- the wire section to use a page with a slightly different layout, use the wire archive as an archive and not the main landing page for issues
- update wire sidebar so news category js functions don't happen

## Added
- page-the-wire.php new page template for the wire
- template-parts/content-wire-grid.php for reuse in wire templates


## Version 1.1.0
Date: 2/12/2020
Developer: Norman Huelsman

### Add
- add The Wire section to WRC site


## Version 1.0.1
Date: 9/3/2019
Developer: Norman Huelsman

### Added 
- changelog.md

### Updated
- theme version number in style.css