# West Kingdom Infrastructure

This project exists to have a place (server) where we can:

a. Hold credentials
b. Do periodic and on-demand operations using those credentials

This server is currently running in a shared instance on Dreamhost.

## Security

Some of the West Kingdom services are interconnected.  For example, the Drupal website that runs westkingdom.org uses the "Organic Groups" module to manage officer groups, and this data in turn is used to add and remove users in Google Apps to manage the officer mailing lists.

Keeping credentials in this server keeps them off of other servers, such as the one running the Drupal CMS.  Of course, it would be bad if an unauthorized user gained access to the server running the CMS, but this way, we can at least keep the credentials to other services from exposure by this route.

To avoid credentials leakage from this server, absolutely no user data is used in any operation: all of the web service endpoints are parameterless.  This minimizes the attack vectors available.

## Infrastructure Server Structure

The contents of this server are as follows:

- .drush: Contains Drush aliases for accessing westkingdom.org
- .google-api: Contains credentials for the Google Apps API
- .php: Contains directives to configure Dreamhost to use PHP 7.
- .ssh: Contains keys that have access to westkingdom.org and GitHub.
- infrastructure: Web services
- scripts:
  - setup: Run to set up tools & c. the first time
- tools
  - drush: Used to fetch the organic groups data
  - hierarchical-email-cli: Used to push updates to Google Apps groups

Clearly, all of the credentials live on the server, but are not committed in this repository. Otherwise it would sort of defeat the purpose.

