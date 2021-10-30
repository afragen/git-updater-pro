[unreleased]
* remove errant comma

#### 1.3.4 / 2021-10-27
* update REST API routes
* update `Remote Management` tab information

#### 1.3.3 / 2021-10-22
* more efficient removal of `current_branch` from cache

#### 1.3.2 / 2021-10-22
* use `try/catch` and `UnexpectedValueException` for error messaging in `reset-branch`
* correctly remove `current_branch` from cache for `reset-branch` REST endpoint

#### 1.3.1 / 2021-10-21
* use `Rest_Update::log_exit()` for better messaging with `reset-branch` REST endpoint

#### 1.3.0 / 2021-10-21
* use `sanitize_title_with_dashes()` as `sanitize_file_name()` maybe have attached filter that changes output
* update `class REST_API` with new endpoint `reset-branch` to reset the saved branch of a plugin or theme

#### 1.2.3 / 2021-09-04
* fix for PHP 5.6 compatibility
* add error checking to `Branch::set_branch_on_switch()` when directory renamed

#### 1.2.2 / 2021-08-18
* only use `esc_attr_e` for translating strings
* un-deprecate `github-updater/v1/update`, issue deprecation message if used

#### 1.2.1 / 2021-07-21
* use `Primary Branch` header for default in `REST_Update` if available
* load `site_transient` hooks in Git Updater during WP-CLI

#### 1.2.0 / 2021-07-05
* remove Freemius from the autoloader
* ensure `is_plugin_active()` is available when needed
* utilize new `class Ignore` from Git Updater
* uses new `class Fragen\Git_Updater\Shim` for PHP 5.6 compatibility, will remove when WP core changes minimum requirement

#### 1.1.1 / 2021-06-14
* utilize new `class Ignore` in Git Updater
* update Freemius menu for multisite

#### 1.1.0 / 2021-06-02
* add filter to skip updating from Git Updater
* add filter to display this plugin in GitHub subtab without errors

#### 1.0.3 / 2021-05-22
* update constant for WPCS

#### 1.0.2 / 2021-05-21
* add language pack updates
* add check when Git Updater loaded as mu-plugin

#### 1.0.1 / 2021-05-18
* ensure custom icon shows in update notice from Freemius

#### 1.0.0 / 2021-05-11
* migrate update, install, REST API, WP-CLI, remote management code over
* add Zipfile_API code over
* add Branch class code over
* add Freemius integration
* update logo branding
