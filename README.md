ChatBot for Kanboard
=================

[![Build Status](https://travis-ci.org/kanboard/plugin-chat.svg?branch=master)](https://travis-ci.org/kanboard/plugin-chat)

Minimalistic ChatBot for Kanboard.

- Only one room for all users (small team)
- No one to one chat
- Notification on user mention
- Replies from OpenAI ChatGPT
- Simplified Markdown rendering
- History of 50 visible messages
- Highlight unread messages
- 3 different views: minimized, normal and maximized
- Auto-flush old messages in database to avoid large table

Author
------
- Damien Trog
- Baed on Chat plugin code from Frédéric Guillot
- License MIT

Requirements
------------

- Kanboard >= 1.2.3

Installation
------------

You have the choice between 3 methods:

1. Install the plugin from the Kanboard plugin manager in one click
2. Download the zip file and decompress everything under the directory `plugins/ChatBot`
3. Clone this repository into the folder `plugins/ChatBot`

Note: Plugin folder is case-sensitive.

Configuration
-------------

From the application settings, you can adjust the chat settings: