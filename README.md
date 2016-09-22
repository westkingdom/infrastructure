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

The local working copy of this repository on the infrastructure server is cloned to the home directory of the infrastructure user -- in other words, /home/wk_infrastructure/.git.

The contents of this server are as follows:

- .bash*: $PATH settings for the bash shell
- .drush: Contains Drush aliases for accessing westkingdom.org
- .google-api: Contains credentials for the Google Apps API
- .php: Contains directives to configure Dreamhost to use PHP 7.
- .ssh: Contains keys that have access to westkingdom.org and GitHub.
- data:
  - currentstate.westkingdom.org.yaml: Data last pushed to Google Apps
  - server.westkingdom.org.yaml: Data pulled from westkingdom.org
- infrastructure: Web services
- scripts:
  - install: Install composer dependencies for our tools
  - sync-email-groups: Refresh data from westkingdom.org and sync with Google Apps
- tools
  - drush: Used to fetch the organic groups data
  - hierarchical-email-cli: Used to push updates to Google Apps groups

Clearly, the various credentials that are stored on the server are not committed in this repository. Otherwise it would sort of defeat the purpose.

## Composer Resource Limitations

Our tiny shared instance server does not have enough resources to be able to run 'composer udpate', or even 'composer require' for a component not yet installed on the system.  These Composer operations are extremely resource-intensive, even for small applications.

Dreamhost reports the following error message when it kills a resource-intensive program:

    Yikes! One of your processes (php, pid 3881) was just killed for excessive resource usage. Please contact DreamHost Support for details.

The 'composer install' operation, on the other hand, runs with very little resource requirements, as long as there is a 'composer.lock' file present.  We therefore commit the composer.json and composer.lock file for each component we wish to install via Composer, and use the 'install' script to ensure these remain up-to-date.  This script should be run the first time this repository is cloned, and every time a newer set of files is pulled.

## Dreamhost Documentation References

- https://help.dreamhost.com/hc/en-us/articles/214200668-How-do-I-create-a-phprc-file-via-SSH-
- https://help.dreamhost.com/hc/en-us/articles/214899037-Installing-Composer-overview
