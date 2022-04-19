<p align="center">
  <img 
    src="https://user-images.githubusercontent.com/82861332/163880389-108756b5-49e6-4d49-b6ab-df3b89acbcfa.png"
  >
</p>

Joomla Plugin Example
=====================

This Is An Example Plugin File For [Joomla!](http://joomla.org/) CMS.

Creator: [Trijal Bhardwaj](https://github.com/Trijal-Bhardwaj/)

This Repository is Maintained For My Submission Of Joomla Plugin GSoC 2022 Programming Task P5 Schema
-----

# CustomFieldForm Plugin
1. Shows two form fields in the backend article view.
2. When a user activates the plugin, it displays the form values below the article in the front-end.
3. The plugin only executes in the frontend.
4. The plugin is installable through the Joomla Extension Manager.

## Configuration

### Initial Setup For The Plugin

1. Download or clone this package. [Download the latest version of the plugin](https://github.com/Trijal-Bhardwaj/Joomla-Plugin-GSoC-2022-Programming-Task-P5-Schema/)
2. Rename all `example` string to your plugin name.
3. Rename all `folder` string to your plugin group name.
4. Move whole folder to Joomla! dir: `/plugins/(your group)/(your plugin)`
5. Go to Joomla! Administrator -> Extension -> Discover and press `Discover` button.
6. Choose your plugin and install it.


Now The Inital Setup Is Completed.

```PHP
class PlgContentcustomfield extends CMSPlugin {
    public function onContentPrepareData() {
    }
    public function onContentPrepareForm() {
    }
    public function onContentBeforeSave() {
    }
    public function onContentAfterDisplay() {
    }
}
```

## Plugin Specifications:
- Type: <b> System </b> <br/>
- Events Used: <b> onContentPrepareData , onContentPrepareForm , onContentBeforeSave , onContentAfterDisplay </b>
- Installable Through The <b> Joomla Extension Manager</b>.
- Executed In The <b> BackEnd</b>.
- Follows <b> Joomla Coding Standards</b>.
- Follows Joomla <b> Naming Conventions</b> .
- <b> Joomla CodeSniffer </b> Configured.

## Plugin Folder Structure

    ├── forms
    │	customfield.xml
    ├── language
    │	└──en-GB
    │   	└── plg_content_customfield.ini
    │   	└── plg_content_customfield.sys.ini
    ├── sql
    │	└──mysql
    │   	└── install.mysql.utf8.sql
    │   	└── uninstall.mysql.utf8.sql
    │	└──sqlazure
    │   	└── install.sqlazure.utf8.sql
    │   	└── uninstall.sqlazure.utf8.sql
    └── customfield.php
    └── customfield.xml
    └── customfield.zip

### Update Server

Please note that my update server only supports the latest version running the latest version of Joomla and atleast PHP 7.0.
Any other plugin version I may have added to the download section don't get updates using the update server.

## Issues / Pull Requests

You have found an Issue, have a question or you would like to suggest changes regarding this extension?
[Open An Issue In This Repo](https://github.com/Trijal-Bhardwaj/Joomla-Plugin-GSoC-2022-Programming-Task-P5-Schema/issues/new) or submit a pull request with the proposed changes.

## Translations

You want to translate this extension to your own language? Check out the [Crowdin Page For My Extensions](https://joomla.crowdin.com) for more details. Feel free to [Open An Issue Here](https://github.com/Trijal-Bhardwaj/Joomla-Plugin-GSoC-2022-Programming-Task-P5-Schema/issues/new) on any question that comes up.

## License

[![MIT License](https://img.shields.io/apm/l/atomic-design-ui.svg?)](https://github.com/tterb/atomic-design-ui/blob/master/LICENSEs)
[![GPLv3 License](https://img.shields.io/badge/License-GPL%20v3-yellow.svg)](https://opensource.org/licenses/)
[![AGPL License](https://img.shields.io/badge/license-AGPL-blue.svg)](http://www.gnu.org/licenses/agpl-3.0)

# Hi, I'm Trijal Bhardwaj, You Can Connect With Me Regarding Any Queries Here :)! 👋

## 🔗 Links
[![linkedin](https://img.shields.io/badge/linkedin-0A66C2?style=for-the-badge&logo=linkedin&logoColor=white)](https://www.linkedin.com/in/trijal-bhardwaj/)
