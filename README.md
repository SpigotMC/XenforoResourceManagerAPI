## XenforoResourceManagerAPI
This project aims to safely expose information from the [SpigotMC](https://spigotmc.org) website in a machine-readable format for use in projects and other systems.

### Current Capabilities
| Action                 | Description                                                                                            |
|------------------------|------------------------------------------------------------------------------------------------------- |
| listResources          | get information about all resources in the system                                                      |             
| getResource            | get information about a resource by its ID                                                             |
| getResourcesByAuthor   | get information about all resources created by a specific author by the user id                        |
| listResourceCategories | get information about available resource categories                                                    |
| getResourceUpdate      | get information about a specific resource update by its id                                             |
| getResourceUpdates     | get information about all of the updates for a specific resource by the resource id                    |
| getAuthor              | get information about an author by the user id                                                         |
| findAuthor             | get information about an author by the username (**exact username match only**)                        |

### How To Use
All requests must currently be sent via **GET** to https://api.spigotmc.org/simple/0.2/index.php. To get started, attach a **GET** parameter `action` specifying which operation you'd like to perform (seen above). Then, attach the action's **GET** parameter(s). See below for information on the parameters that each action accepts.

### Documentation

#### listResources
##### Parameters:
| name 	    | type 	| required 	| default 	| description                                                                 	|
|---------- |------	|----------	|---------	|-----------------------------------------------------------------------------	|
| category  | int  	| no       	| none    	| The resource category to restrict results to (see `listResourceCategories`) 	|
| page 	    | int  	| no       	| 1       	| The page number to retrieve. Items are paginated at 10 results per page.    	|
##### Request: https://api.spigotmc.org/simple/0.2/index.php?action=listResources&category=4&page=2
##### Response (truncated):
```json
[
  {
    "id":"12",
    "title":"BungeeLobbyKick",
    "tag":"This plugin will move all players to a configured server on command",
    "current_version":"0.2",
    "category":{
      "id":3,
      "title":"Bungee - Proxy",
      "description":"Bungee plugins that interact directly with the proxy plugins folder."
    },
    "native_minecraft_version":null,
    "supported_minecraft_versions":null,
    "icon_link":"https:\/\/www.spigotmc.org\/styles\/default\/xenresource\/resource_icon.png",
    "author":{
      "id":"1013",
      "username":"fuzzy_bot"
    },
    "premium":{
      "price":"0.00",
      "currency":""
    },
    "stats":{
      "downloads":"2789",
      "updates":"0",
      "reviews":{
        "unique":"12",
        "total":"12"
      },
      "rating":"4.58333"
    },
    "first_release":1364338800,
    "last_update":1364338800,
    "description":"[B]This plugin will move all players to a configured server when one of these commands is run:[\/B]\n\n[B]\/lobbykick (Kick all players to lobby)[\/B]\n[B]\/lobbykickstop (lobbykick + Runs console command stop)[\/B]\n[B]\/lobbykickrestart ([\/B][B]lobbykick +[\/B][B]Runs console command restart <- this is a spigot feature)[\/B]\n\n\n[B]All of the above commands require the permission \"Lobby.Kick\" or may be run from the console.[\/B]\n\n[B]\/lobbykickplayer playername (kick 1 player, Requires Lobby.Kick.Player permission)[\/B]\n\n[B]The server name to move the players to is in the \"config.yml\" file in the BungeeLobbyKick folder. The default is to move players to the server \"lobby\". You can reload this file using:[\/B]\n\n[B]\/lobbykickreload (rereads config file)[\/B]"
  },
  {
    "id":"13",
    "title":"BungeeKickStop",
    "tag":"Bungee Kick control plugin - move players to a different server when kicked",
    "current_version":"0.1",
    "category":{
      "id":3,
      "title":"Bungee - Proxy",
      "description":"Bungee plugins that interact directly with the proxy plugins folder."
    },      
    "native_minecraft_version":null,
    "supported_minecraft_versions":null,
    "icon_link":"https:\/\/www.spigotmc.org\/styles\/default\/xenresource\/resource_icon.png",
    "author":{
      "id":"1013",
      "username":"fuzzy_bot"
    },
    "premium":{
      "price":"0.00",
      "currency":""
    },
    "stats":{
      "downloads":"1776",
      "updates":"0",
      "reviews":{
        "unique":"3",
        "total":"3"
      },
      "rating":"5"
    },
    "first_release":1364338800,
    "last_update":1364338800,
    "description":"BungeeKickStop moves players to a configured server when the player is kicked with a specific message.\n \nConfiguration is in the config.txt file. An empty file is generated the first time you start the plugin.\n \ncreate lines in config.txt to setup the kick filters:\n \nservername!!!Kick Text!!!Message &dto &fuser\n \nWhen a player is kicked the kick is evaluated for \"Kick Text\"\nif this is found, the player is sent to \"servername\" server and also told \"Message &dto &fuser\"\n \nwith permission bks.reload use the command \/bksreload to reload the configuration\n \n \n** Note ** This requires the latest version of Bungee!"
  }
]
```

#### getResource
##### Parameters:
| name 	| type 	| required 	| default 	| description                                     |
|------	|------	|----------	|---------	|------------------------------------------------ |
| id  	| int  	| yes       | none    	| The id of the resource to retrieve              |
##### Request: https://api.spigotmc.org/simple/0.2/index.php?action=getResource&id=2
##### Response:
```json
{
  "id":"2",
  "title":"HubKick",
  "tag":"Send players to lobby on kick. \/lobby \/ hub",
  "current_version":"1.7.1",
  "category":{
    "id":2,
    "title":"Bungee - Spigot",
    "description":"Spigot plugins that interact with BungeeCord."
  },    
  "native_minecraft_version":null,
  "supported_minecraft_versions":[
    "1.7",
    "1.8",
    "1.9"
  ],
  "icon_link":"https:\/\/www.spigotmc.org\/data\/resource_icons\/0\/2.jpg?1482076430",
  "author":{
    "id":"106",
    "username":"LaxWasHere"
  },
  "premium":{
    "price":"0.00",
    "currency":""
  },
  "stats":{
    "downloads":"7719",
    "updates":"22",
    "reviews":{
      "unique":"11",
      "total":"11"
    },
    "rating":"5"
  },
  "first_release":1364338800,
  "last_update":1515884400,
  "description":"[CENTER][I][B][URL='https:\/\/discord.gg\/SvFEBGW'][IMG]https:\/\/i.imgur.com\/inmwaK3.png[\/IMG] [\/URL]| [URL='https:\/\/www.paypal.me\/LaxWasHere'][IMG]https:\/\/i.imgur.com\/h5YgdLC.png[\/IMG][\/URL] | [URL='https:\/\/github.com\/AwesomePowered\/HubKick'][IMG]https:\/\/i.imgur.com\/ikjLwXh.png[\/IMG][\/URL][\/B][\/I][\/CENTER]\n[I][B]Info[\/B]\nWhen a player get's kicked from the server, this plugin will forward him\/her to the server you specified in the config.yml.\nKick everyone and shutdown the server or just kick everyone.\n\n[B]Configuration[\/B]\n[code]#Hub is the server you want the players to be sent to.\nHubServer: hub\n\n#Enable this and it will pick a hub on random when kicked\nHubs:\n- Hub\n- Lobby\nrandomHubs: false\n\n#Regex pattern for forcekicking a player. No touchy touchy pls\nignorePattern: '(\\bafk|AFK|-f\\b)'\n\n#Prefix\nprefix: '&4[&aHubKick&4]'\n\n#Message to be sent when kicking everyone\/ shutting down the server.\nKickallMessage: '&a&lServer shutting down, you have been kicked to the hub!'\n\n#Should the plugin send the users on hub on kick?\nHubOnKick: true\n[\/code]\n\n[B]Installation[\/B]\n [\/I]\n[LIST]\n[I]\n[LIST][*]Drop the HubKick.jar at your \/plugins folder[\/LIST]\n[LIST][*]Restart Server[\/LIST]\n[LIST][*]Get Kicked[\/LIST][\/I]\n[\/LIST]\n[I][B]Commands:[\/B]\n[CODE]\/hub (sends you to he hub server)\n\/lobby (same as above)\n\/alltolobby (sends everyone to lobby)\n\/lobbyall (Same as above)\n\/sendplayer(Sends player to a server)\n\/sendp(^)\n\/shutdown (sends everyone to lobby and shuts down the server)\n\/forcekick (kicked the player off the network) (or simply add -f to a kick message)\n\/fkick (same as above)\n[\/CODE]\n\n[B]Permissions:[\/B]\n [\/I]\n[LIST]\n[I]\n[LIST][*]hubkick.command[\/LIST]\n[LIST][*]hubkick.kickall[\/LIST]\n[LIST][*]hubkick.send[\/LIST]\n[LIST][*]hubkick.shutdown[\/LIST]\n[LIST][*]hubkick.forcekick[\/LIST][\/I]\n[\/LIST]\n[I][URL='https:\/\/github.com\/AwesomePowered\/HubKick']Github[\/URL][\/I]"
}
```

#### getResourcesByAuthor
##### Parameters:
| name 	| type 	| required 	| default 	| description                                                                 	|
|------	|------	|----------	|---------	|-----------------------------------------------------------------------------	|
| id  	| int  	| yes       | none    	| The id of the author to restrict results to (see `findAuthor`) 	              |
| page 	| int  	| no       	| 1       	| The page number to retrieve. Items are paginated at 10 results per page.    	|
##### Request: https://api.spigotmc.org/simple/0.2/index.php?action=getResourcesByAuthor&id=100356&&page=1
##### Response (truncated):
```json
[
  {
    "id":"57242",
    "title":"spark",
    "tag":"spark is a performance profiling plugin\/mod for Minecraft clients, servers and proxies.",
    "current_version":"1.6.1", 
    "category":{
      "id":15,
      "title":"Tools and Utilities",
      "description":""
    },
    "native_minecraft_version":"",
    "supported_minecraft_versions":[
      "1.8",
      "1.9",
      "1.10",
      "1.11",
      "1.12",
      "1.13",
      "1.14",
      "1.15",
      "1.16",
      "1.17"
    ],
    "icon_link":"https:\/\/www.spigotmc.org\/data\/resource_icons\/57\/57242.jpg?1615457966",
    "author":{
      "id":"100356",
      "username":"Luck"
    },
    "premium":{
      "price":"0.00",
      "currency":""
    },
    "stats":{
      "downloads":"16589",
      "updates":"10",
      "reviews":{
        "unique":"49",
        "total":"53"
      },
      "rating":"4.89796"
    },
    "first_release":1527458400,
    "last_update":1733007600,
    "description":"[CENTER][B][SIZE=7][IMG]https:\/\/i.imgur.com\/cJ4sYV5.png[\/IMG]  [\/SIZE][\/B]\n[SIZE=4][B]spark is a performance profiling plugin\/mod for Minecraft clients, servers and proxies.[\/B][\/SIZE]\n[\/CENTER]\n[B]Useful Links[\/B]\n[LIST]\n[*][B][URL='https:\/\/spark.lucko.me\/']Website[\/URL][\/B] - browse the project homepage\n[*][B][URL='https:\/\/spark.lucko.me\/docs']Documentation[\/URL][\/B] - read documentation and usage guides\n[*][B][URL='https:\/\/spark.lucko.me\/download']Downloads[\/URL][\/B] - latest development builds\n[\/LIST]\n[B][SIZE=5]What does it do?[\/SIZE][\/B]\nspark is made up of a number of components, each detailed separately below.\n[LIST]\n[*][B]CPU Profiler[\/B]: Diagnose performance issues.\n[*][B]Memory Inspection[\/B]: Diagnose memory issues.\n[*][B]Server Health Reporting[\/B]: Keep track of overall server health.\n[\/LIST]\n\n[B][SIZE=6]\u26a1 CPU Profiler[\/SIZE][\/B]\nspark's profiler can be used to diagnose performance issues: \"lag\", low tick rate, high CPU usage, etc.\n\nIt is:\n[LIST]\n[*][B]Lightweight[\/B] - can be ran in production with minimal impact.\n[*][B]Easy to use[\/B] - no configuration or setup necessary, just install the plugin\/mod.\n[*][B]Quick to produce results[\/B] - running for just ~30 seconds is enough to produce useful insights into problematic areas for performance.\n[*][B]Customisable[\/B] - can be tuned to target specific threads, sample at a specific interval, record only \"laggy\" periods, etc\n[*][B]Highly readable[\/B] - simple tree structure lends itself to easy analysis and interpretation. The viewer can also apply deobfuscation mappings.\n[\/LIST]\nIt works by sampling statistical data about the systems activity, and constructing a call graph based on this data. The call graph is then displayed in an online viewer for further analysis by the user.\n\nThere are two different profiler engines:\n[LIST]\n[*]Native [ICODE]AsyncGetCallTrace[\/ICODE] + [ICODE]perf_events[\/ICODE] - uses [URL='https:\/\/github.com\/jvm-profiling-tools\/async-profiler']async-profiler[\/URL] ([I]only available on Linux x86_64 systems[\/I])\n[*]Built-in Java [ICODE]ThreadMXBean[\/ICODE] - an improved version of the popular [URL='https:\/\/github.com\/sk89q\/WarmRoast']WarmRoast profiler[\/URL] by sk89q.\n[\/LIST]\n[B]\n[SIZE=6]\u26a1 Memory Inspection[\/SIZE][\/B]\nspark includes a number of tools which are useful for diagnosing memory issues with a server.\n[LIST]\n[*][B]Heap Summary[\/B] - take & analyse a basic snapshot of the servers memory\n[LIST]\n[*]A simple view of the JVM's heap, see memory usage and instance counts for each class\n[*]Not intended to be a full replacement of proper memory analysis tools. (see below)\n[\/LIST]\n[\/LIST]\n[LIST]\n[*][B]Heap Dump[\/B] - take a full (HPROF) snapshot of the servers memory\n[LIST]\n[*]Dumps (& optionally compresses) a full snapshot of JVM's heap.\n[*]This snapshot can then be inspected using conventional analysis tools.\n[\/LIST]\n[\/LIST]\n[LIST]\n[*][B]GC Monitoring[\/B] - monitor garbage collection activity on the server\n[LIST]\n[*]Allows the user to relate GC activity to game server hangs, and easily see how long they are taking & how much memory is being free'd.\n[*]Observe frequency\/duration of young\/old generation garbage collections to inform which GC tuning flags to use\n[\/LIST]\n[\/LIST]\n[B][SIZE=6]\u26a1 Server Health Reporting[\/SIZE][\/B]\nspark can report a number of metrics summarising the servers overall health.\n\nThese metrics include:\n[LIST]\n[*][B]TPS[\/B] - ticks per second, to a more accurate degree indicated by the \/tps command\n[*][B]Tick Durations[\/B] - how long each tick is taking (min, max and average)\n[*][B]CPU Usage[\/B] - how much of the CPU is being used by the server process, and by the overall system\n[*][B]Memory Usage[\/B] - how much memory is being used by the process\n[*][B]Disk Usage[\/B] - how much disk space is free\/being used by the system\n[\/LIST]\nAs well as providing tick rate averages, spark can also monitor individual ticks - sending a report whenever a single tick's duration exceeds a certain threshold. This can be used to identify trends and the nature of performance issues, relative to other system or game events.\n\n\n[SIZE=5][B]Us[SIZE=5]a[\/SIZE]ge[\/B][\/SIZE]\nTo install, just add the [B]spark.jar[\/B] file to your servers plugins directory.\n\nInformation about [URL='https:\/\/spark.lucko.me\/docs\/Command-Usage']how to use commands[\/URL] can be found in the docs.\n\nIf you\u2019d like help analysing a profiling report, or just want to chat, feel free to join us on [URL='https:\/\/discord.gg\/PAGT2fu']Discord[\/URL].\n\n\n[B][SIZE=5]Guides[\/SIZE][\/B]\nThere are a few small \"guides\" available in the docs, covering the following topics.\n[LIST]\n[*][URL='https:\/\/spark.lucko.me\/docs\/guides\/The-tick-loop']The tick loop[\/URL]\n[*][URL='https:\/\/spark.lucko.me\/docs\/guides\/Finding-lag-spikes']Finding the cause of lag spikes[\/URL]\n[\/LIST]"
  },
  {
    "id":"28140",
    "title":"LuckPerms",
    "tag":"A permissions plugin for Minecraft servers (Bukkit\/Spigot, BungeeCord & more)",
    "current_version":"5.3.47", 
    "category":{
      "id":21,
      "title":"Universal",
      "description":""
    },
    "native_minecraft_version":"",
    "supported_minecraft_versions":[
      "1.7",
      "1.8",
      "1.9",
      "1.10",
      "1.11",
      "1.12",
      "1.13",
      "1.14",
      "1.15",
      "1.16",
      "1.17"
    ],
    "icon_link":"https:\/\/www.spigotmc.org\/data\/resource_icons\/28\/28140.jpg?1490821714",
    "author":{
      "id":"100356",
      "username":"Luck"
    },
    "premium":{
      "price":"0.00",
      "currency":""
    },
    "stats":{
      "downloads":"1466009",
      "updates":"42",
      "reviews":{
        "unique":"826",
        "total":"926"
      },
      "rating":"4.77603"
    },
    "first_release":1471644000,
    "last_update":1748210400,
    "description":"[RIGHT][URL='https:\/\/luckperms.net\/download']Looking for the BungeeCord download? Click here![\/URL][\/RIGHT]\n[CENTER][IMG]https:\/\/raw.githubusercontent.com\/LuckPerms\/branding\/master\/banner\/banner.png[\/IMG][\/CENTER]\n[IMG]https:\/\/i.imgur.com\/7vjPbyM.png[\/IMG]\nLuckPerms is a permissions plugin for Minecraft servers (Bukkit\/Spigot, BungeeCord & more). It allows server admins to control what features players can use by creating groups and assigning permissions.\n\nIt is:\n[LIST]\n[*][B]fast[\/B] - written with performance and scalability in mind.\n[*][B]reliable[\/B] - trusted by thousands of server admins, and the largest of server networks.\n[*][B]easy to use[\/B] - setup permissions using commands, directly in config files, or using the web editor.\n[*][B]flexible[\/B] - supports a variety of data storage options, and works on lots of different server types.\n[*][B]extensive[\/B] - a plethora of customization options and settings which can be changed to suit your server.\n[*][B]free[\/B] - available for download and usage at no cost, and permissively licensed so it can remain free forever.\n[\/LIST]\nFor more information, see the wiki article on [URL='https:\/\/luckperms.net\/wiki\/Why-LuckPerms']Why LuckPerms?[\/URL]\n\n[IMG]https:\/\/i.imgur.com\/E5SUQSP.png[\/IMG]\nThe latest downloads & other useful links can be found on the project homepage at [URL='https:\/\/luckperms.net\/']luckperms.net[\/URL].\n\nThe plugin has extensive [URL='https:\/\/luckperms.net\/wiki']documentation available on the wiki[\/URL]. Please use the resources there before coming to us directly for support.\n\nSupport for the plugin is provided on [URL='https:\/\/discord.gg\/luckperms']Discord[\/URL]. If you have a question which cannot be answered by reading the wiki, the best place to ask it is there.\n\nIf you would like to report a bug, please [URL='https:\/\/github.com\/lucko\/LuckPerms\/issues']open a ticket on GitHub[\/URL].\n\n[IMG]https:\/\/i.imgur.com\/3kfqrp1.png[\/IMG]\n[URL='https:\/\/bisecthosting.com\/luck'][IMG]https:\/\/i.imgur.com\/fpcKnbV.png[\/IMG][\/URL]\n[CENTER]LuckPerms is proudly sponsored by [URL='https:\/\/bisecthosting.com\/luck']BisectHosting[\/URL].[\/CENTER]\n\nThey've kindly offered LuckPerms users a massive [B]25% off[\/B] the first month of any of their game server hosting plans. To get the discount, just enter the promo code [B]luck[\/B] at checkout!\n\n[IMG]https:\/\/i.imgur.com\/zflMO8M.png[\/IMG]\nMost of the other available permission plugins date back a number of years, and were created in the early Bukkit era. Almost without exception, they've been abandoned by their original authors, and receive no updates, support or bug fixes.\n\nLuckPerms is still a growing and active resource, and I endeavour to reply to all bug reports, issues and feature requests in a timely manner.\n\nLuckPerms supports fully automatic migration and data transfer from existing permissions plugins.\nFor more information about this process, please [URL='https:\/\/luckperms.net\/wiki\/Migration']read the wiki page[\/URL].\n\n[IMG]https:\/\/i.imgur.com\/CzC56lP.png[\/IMG]\nPlease don't post bug reports\/suggestions in the review section. Bugs should be reported by [URL='https:\/\/github.com\/lucko\/LuckPerms\/issues']opening a ticket on GitHub[\/URL].\n\nIf you just have a question, the best place to ask is in our Discord server. Either myself or somebody else will hopefully be able to assist.\n\nThis plugin took me while to make, so if you find it useful, a nice review would be appreciated. :) On the other hand, if you have suggestions, I'd love to hear those too!\n\n[B]If you're having issues using the plugin, please contact me BEFORE making a review. I *cannot* give support in the review section.[\/B]"
  }
]
```

#### listResourceCategories
##### Parameters: **none**
##### Request: https://api.spigotmc.org/simple/0.2/index.php?action=listResourceCategories
##### Response (truncated):
```json
[
  {
    "id":"2",
    "title":"Bungee - Spigot",
    "description":"Spigot plugins that interact with BungeeCord."
  },
  {
    "id":"3",
    "title":"Bungee - Proxy",
    "description":"Bungee plugins that interact directly with the proxy plugins folder."
  },
  {
    "id":"4",
    "title":"Spigot",
    "description":"Plugins which work on a standard Spigot install."
  },
  {
    "id":"5",
    "title":"Transportation",
    "description":""
  },
  {
    "id":"6",
    "title":"Chat",
    "description":""
  },
  {
    "id":"7",
    "title":"Tools and Utilities",
    "description":""
  },
  {
    "id":"8",
    "title":"Misc",
    "description":""
  },
  {
    "id":"9",
    "title":"Libraries \/ APIs",
    "description":""
  },
  {
    "id":"10",
    "title":"Transportation",
    "description":""
  }
]
```

#### getResourceUpdate
##### Parameters:
| name 	| type 	| required 	| default 	| description                                                                 	|
|------	|------	|----------	|---------	|-----------------------------------------------------------------------------	|
| id  	| int  	| yes       | none    	| The id of the **resource _update_** to retrieve (see `getResourceUpdates`) 	  |
##### Request: https://api.spigotmc.org/simple/0.2/index.php?action=getResourceUpdate&id=352711
##### Response:
```json
{
  "id":"352711",
  "resource_id":"6245",
  "download_count":282429,
  "title":"2.10.9 back to normal",
  "message":"[B][SIZE=6]2.10.9\n[\/SIZE][\/B]\n[LIST]\n[*][SIZE=4]Fixed issues with maven repo regarding Jetbrains annotations when using other IDE's[\/SIZE]\n[\/LIST]\n[SIZE=4]Like this update to pay respects[\/SIZE]\n[LIST]\n[*][SIZE=4]Updated deprecation methods in PlaceholderAPI class. Now normal methods of setPlaceholders will not nag you regardless if you use Player or OfflinePlayer.. This also resolves issues with plugins providing placeholders as both methods pre 2.10.7 are functional from PlaceholderHook. Use onRequest or onPlaceholderRequest.... Doesn't matter until we hit 3.0.0.  [\/SIZE]\n[*][SIZE=4]Fixed a few bugs that probably wont be noticed but if you really care about them you can follow the trail if you are on the hunt [\/SIZE]\n[\/LIST]\n[URL]https:\/\/github.com\/PlaceholderAPI\/PlaceholderAPI\/commits\/master[\/URL]\n\nThis update was mainly focused on people who actually hook into PlaceholderAPI so I hope this resolves any issues you may have with deprecated methods or stuff not working. I really don't want people using the dev repo as a way to release updates however they are a good way for everyone to test. Based on the feedback I felt this was the thing to do as we don't want to break things until PAPI3 drops.\n[SIZE=4]\n\n\n[\/SIZE]"
}
```

#### getResourceUpdates
##### Parameters:
| name 	| type 	| required 	| default 	| description                                                                 	|
|------	|------	|----------	|---------	|-----------------------------------------------------------------------------	|
| id  	| int  	| yes       | none    	| The id of the resource for which to retrieve updates                          |
| page 	| int  	| no       	| 1       	| The page number to retrieve. Items are paginated at 10 results per page.    	|
##### Request: https://api.spigotmc.org/simple/0.2/index.php?action=getResourceUpdates&id=2&page=1
##### Response (truncated):
```json
[
  {
    "id":"2",
    "resource_id":"2",
    "download_count":251,
    "title":"HubKick",
    "message":"[CENTER][I][B][URL='https:\/\/discord.gg\/SvFEBGW'][IMG]https:\/\/i.imgur.com\/inmwaK3.png[\/IMG] [\/URL]| [URL='https:\/\/www.paypal.me\/LaxWasHere'][IMG]https:\/\/i.imgur.com\/h5YgdLC.png[\/IMG][\/URL] | [URL='https:\/\/github.com\/AwesomePowered\/HubKick'][IMG]https:\/\/i.imgur.com\/ikjLwXh.png[\/IMG][\/URL][\/B][\/I][\/CENTER]\n[I][B]Info[\/B]\nWhen a player get's kicked from the server, this plugin will forward him\/her to the server you specified in the config.yml.\nKick everyone and shutdown the server or just kick everyone.\n\n[B]Configuration[\/B]\n[code]#Hub is the server you want the players to be sent to.\nHubServer: hub\n\n#Enable this and it will pick a hub on random when kicked\nHubs:\n- Hub\n- Lobby\nrandomHubs: false\n\n#Regex pattern for forcekicking a player. No touchy touchy pls\nignorePattern: '(\\bafk|AFK|-f\\b)'\n\n#Prefix\nprefix: '&4[&aHubKick&4]'\n\n#Message to be sent when kicking everyone\/ shutting down the server.\nKickallMessage: '&a&lServer shutting down, you have been kicked to the hub!'\n\n#Should the plugin send the users on hub on kick?\nHubOnKick: true\n[\/code]\n\n[B]Installation[\/B]\n [\/I]\n[LIST]\n[I]\n[LIST][*]Drop the HubKick.jar at your \/plugins folder[\/LIST]\n[LIST][*]Restart Server[\/LIST]\n[LIST][*]Get Kicked[\/LIST][\/I]\n[\/LIST]\n[I][B]Commands:[\/B]\n[CODE]\/hub (sends you to he hub server)\n\/lobby (same as above)\n\/alltolobby (sends everyone to lobby)\n\/lobbyall (Same as above)\n\/sendplayer(Sends player to a server)\n\/sendp(^)\n\/shutdown (sends everyone to lobby and shuts down the server)\n\/forcekick (kicked the player off the network) (or simply add -f to a kick message)\n\/fkick (same as above)\n[\/CODE]\n\n[B]Permissions:[\/B]\n [\/I]\n[LIST]\n[I]\n[LIST][*]hubkick.command[\/LIST]\n[LIST][*]hubkick.kickall[\/LIST]\n[LIST][*]hubkick.send[\/LIST]\n[LIST][*]hubkick.shutdown[\/LIST]\n[LIST][*]hubkick.forcekick[\/LIST][\/I]\n[\/LIST]\n[I][URL='https:\/\/github.com\/AwesomePowered\/HubKick']Github[\/URL][\/I]"
  },
  {
    "id":"17",
    "resource_id":"2",
    "download_count":346,
    "title":"Added \/lobby|\/hub command",
    "message":"New commands.\n \n[LIST]\n[*]\/hub\n[*]\/lobby\n[\/LIST]"
  },
  {
    "id":"66",
    "resource_id":"2",
    "download_count":298,  
    "title":"Added permission",
    "message":"Added permission to \/hub, \/lobby command\n \n[B]hubkick.command[\/B]"
  },
  {
    "id":"87",
    "resource_id":"2",
    "download_count":261,
    "title":"Fixed commands",
    "message":"Fixed \/lobby \/hub commands not working."
  },
  {
    "id":"119",
    "resource_id":"2",
    "download_count":971,
    "title":"Metrics",
    "message":"Added Metrics"
  }
]
```

#### getAuthor
##### Parameters:
| name 	| type 	| required 	| default 	| description                                                                 	|
|------	|------	|----------	|---------	|-----------------------------------------------------------------------------	|
| id  	| int  	| yes       | none    	| The id of the author to retrieve 	                                            |
##### Request: https://api.spigotmc.org/simple/0.2/index.php?action=getAuthor&id=1
##### Response:
```json
{
  "id":"1",
  "username":"md_5",
  "resource_count":"12",
  "identities":{
    "twitter":"md__5"
  },
  "avatar":"https:\/\/www.gravatar.com\/avatar\/b53fd878a84d268da2b6456e0b96cae5.jpg?s=96",
  "last_activity":1753109208 
}
```

#### findAuthor
##### Parameters:
| name 	| type 	| required 	| default 	| description                                                                 	          |
|------	|------	|----------	|---------	|---------------------------------------------------------------------------------------	|
| name  | str  	| yes       | none    	| The exactly matching username of the desired user, with escape sequences if necessary 	|
##### Request: https://api.spigotmc.org/simple/0.2/index.php?action=findAuthor&name=simpleauthority
##### Response:
```json
{
  "id":"12157",
  "username":"simpleauthority",
  "resource_count":"8",
  "identities":{
    "discord":"simple#5957"
  },
  "avatar":"https:\/\/www.spigotmc.org\/data\/avatars\/l\/12\/12157.jpg?1623588345",
  "last_activity":1753109208
}
```
