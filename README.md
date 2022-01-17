## Pushe official wordpress plugin for webpush

### Setup

In order to activate this plugin you need to have an **app_id**.

* First go to [pushe's console][console_url]
* Go to the **Web** part 
* Click on the `create new website`
* In the `creation page` check the field that indicates you are using wordpress
* In the next page, there is a code box. click on the `copy` button and copy the **app_id**

Then in the your wordpress panel go to **Add new** plugins, search for **pushe-webpush**, install and activate it.

Now in your left panel you would see a new menu added with the name of **pushe-webpush**. Hover on it then click on the **settings**, now paste your **app_id** in the corresponded field.

And also click on the **enable webpush** to make the plugin works.

Now you can checkout your site to see the webpush dialog.

### More settings

#### Disable the `show dialog`

If your website works on **https** it is not mandatory to show the dialog, and you can only rely on browser's default dialog.

To achieve this you can go to the **Modal Options** page of the plugin and just disable the **show dialog** switch.

#### Show dialog only on specific pages

> By default subscription dialog would be shown in all pages.

In the **setting** page of the plugin you can specify on which pages you want to show the dialog or on which ones you do not.

> To find out your page number, when you are editing your page or your posts you can see the page number in the url of the browser.
>
> e.g. ```post.php?post=2&action=edit```
> 
> this means your page number is **2**

#### Options of dialog

You can simply change the title, content and button's text in the **Modal Options** page.
And also you can specify the position of the dialog in the page.

For further information you can checkout the [documentation][webpush_doc].


[console_url]: https://console.pushe.co
[webpush_doc]: https://docs.pushe.co/docs/wordpress/intro
