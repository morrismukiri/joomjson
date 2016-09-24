# **Joomla JSON** 
*Get joomla content using a JSON API*

All articles requests can be cached locally

## Install
Make sure you have [composer](https://getcomposer.org/) installed and 
cd into the root of the project then Run `composer update`

### configurataion
Copy the 'env.example' file to '.env' in the root directory and modify the values to match your joomla details
```
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=myjoomlasite
DB_TABLE_PREFIX=Fo00_
DB_USERNAME=root
DB_PASSWORD=

APP_VERSION=1.0.0
APP_NAME=JoomJSON
APP_AUTHOR=@morrismukiri
```
# CONTENT API
To retrieve joomla content, call the api using following url format

1. ## Get all Articles
    `GET /articles`

    Returns

    JSON Array of articles in the format
    ```JSON

        [
            {
                "id": 52,
                "title": "Article title",
                "images": "{\"image_intro\":\"\",\"float_intro\":\"\",\"image_intro_alt\":\"\",\"image_intro_caption\":\"\",\"image_fulltext\":\"\",\"float_fulltext\":\"\",\"image_fulltext_alt\":\"\",\"image_fulltext_caption\":\"\"}",
                "introtext": "html text",
                "publish_up": "2015-09-02 08:07:33",
                "created": "2015-09-02 08:07:33",
                "fulltext": "",
                "intro_image": "images/scope4.jpg"
            },
            {
                "id": 54,
                "title": "Second Article title",
                "images": "{\"image_intro\":\"\",\"float_intro\":\"\",\"image_intro_alt\":\"\",\"image_intro_caption\":\"\",\"image_fulltext\":\"\",\"float_fulltext\":\"\",\"image_fulltext_alt\":\"\",\"image_fulltext_caption\":\"\"}",
                "introtext": "html text",
                "publish_up": "2016-05-03 10:37:13",
                "created": "2016-05-03 10:37:13",
                "fulltext": "",
                "intro_image": "images/cool_pic1.jpg"
            }
        ]

    ```

    You can limit the number of articles by appending the maximum number of articles to the url i.e `GET articles/100` to limit top 100

2. ## Get certein number of articles
    `GET /articles/x`  where **x** is the number of articles to get, ordered by date published

    Returns an array of JSON objects as above
3. ## Get specific article
    `GET /article/x `  where **x** is the id of the article to get eg 52

    Returns

    **Article found**
    ```JSON
    {
        "id": 52,
        "title": "Article title",
        "images": "{\"image_intro\":\"\",\"float_intro\":\"\",\"image_intro_alt\":\"\",\"image_intro_caption\":\"\",\"image_fulltext\":\"\",\"float_fulltext\":\"\",\"image_fulltext_alt\":\"\",\"image_fulltext_caption\":\"\"}",
        "introtext": "html text",
        "publish_up": "2015-09-02 08:07:33",
        "created": "2015-09-02 08:07:33",
        "fulltext": "",
        "intro_image": "images/scope4.jpg"
    }
    ```

    **Article not found**
    ```JSON
    {
        "error": "Article can not be found"
    }
    ```

4. ## Get All Categories
    `GET   /categories`

    Returns an array of JSON Objects( structure below) of all categories

5. ## Get category details
    `GET /category/x` where **x** is the category id eg 2

    Returns
        
    **Success**
    ```JSON
    {
        "id": 2,
        "asset_id": 27,
        "parent_id": 1,
        "lft": 1,
        "rgt": 2,
        "level": 1,
        "path": "uncategorised",
        "extension": "com_content",
        "title": "Uncategorised",
        "alias": "uncategorised",
        "note": "",
        "description": "",
        "published": 1,
        "checked_out": 0,
        "checked_out_time": "0000-00-00 00:00:00",
        "access": 1,
        "params": "{\"category_layout\":\"\",\"image\":\"\"}",
        "metadesc": "",
        "metakey": "",
        "metadata": "{\"author\":\"\",\"robots\":\"\"}",
        "created_user_id": 42,
        "created_time": "2011-01-01 00:00:01",
        "modified_user_id": 0,
        "modified_time": "0000-00-00 00:00:00",
        "hits": 0,
        "language": "*",
        "version": 1
    }
    ```
    **not found**
    ```JSON
    {
        "error": "Category not found"
    }
    ```
    
6. ## Articles in a category

    `GET category/x/article` Where **x** is the category id
    
    Returns JSON object array of articles in the category

7. ## Featured articles

    `GET articles/featured/x` Where **x** is the maximum number of articles to return. it is optional and defaults to **10**
    Returns JSON object array of articles marked as featured.

8. ## Latest articles

    `GET articles/latest/x` Where **x** is the maximum number of articles to return. it is optional and defaults to **10**
    Returns JSON object array of recently published articles.

9. Tagged articles
    `GET articles/latest/tag/name/x` where name is the tag name and x is the maximum count of articles to return
