# Schülerfirma Art und Weise

Onlineshop for student company "Art und Weise"

## Setup
You have to install all libraries that are required.
Run `npm install`.
<br/>
You have to set up your workspace. Otherwise, you will get a lot of errors.
Run `npm run update-copy`.

### Update
To update all libraries run `npm run update-copy`.

## Compile SCSS
To compile all the SCSS-files in `/src/scss/` run `npm run compile-folder`.
<br/>
You can also compile all SCSS-files live. They will be compiled everytime you save the edited file.
Run `npm run compile-watch`.

## Serve project
The project comes with a build-in PHP-server. It will serve from the dist directory.
The command `npm run serve` will execute following scripts:
- `start-dev-server`
- `compile-folder`
- `make-dist-ready`

### Contained Scripts
#### `compile-folder`
See section above. Included to improve the workflow.
#### `make-dist-ready`
Copies all non-scss and non-bootstrap-css files into the dist folder. Includes:
- custom JS-files
- PHP-files
- directories
#### `start-dev-server`
Starts the build-in PHP-server which serves from dist folder.

## Example Workflow
### Init
1. Run `npm run update-copy` to initiate the project directory.
2. Run `npm run compile-folder` to compile scss-files to css-files.
3. Run `npm run make-dist-ready` to complete the dist folder with all PHP-files.
### General development
1. Run `npm run serve` to start the build-in PHP-server and generate a fresh dist folder.
2. Run `npm run make-dist-ready` to have the recent PHP-files in your dist folder served by the Server.
3. Run `npm run compile-folder` to compile scss-files to css-files into the dist folder.
4. Run `npm run compile-watch` in a new terminal/task to have continues scss-compiling.
#### SCSS development
1. Run `npm run start-dev-server` to start the web server to see live result.
2. Run `npm run compile-watch` to have live compiling of your scss files.
#### PHP development
1. Follow step 1 and 2 from [General development](README.md#general-development)
2. Run `npm run make-dist-ready` to push your PHP-files to the dist folder served by the PHP-server.

## Info
PHP Version 8.0.2
