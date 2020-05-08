<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ config('auto-doc.info.title') }}</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700|Source+Code+Pro:300,600|Titillium+Web:400,600,700" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/auto-doc/swagger-ui.css">
    <style>
        html
        {
            box-sizing: border-box;
            overflow: -moz-scrollbars-vertical;
            overflow-y: scroll;
        }

        *,
        *:before,
        *:after
        {
            box-sizing: inherit;
        }

        body
        {
            margin:0;
            background: #fafafa;
        }
    </style>
</head>

<body>

<div id="swagger-ui"></div>

<script src="/auto-doc/swagger-ui-bundle.js"></script>
<script src="/auto-doc/swagger-ui-standalone-preset.js"></script>
<script>

    let section ="{{ Request::get('section', "web") }}";

    window.onload = function() {
        // Build a system
        const ui = SwaggerUIBundle({
            url: "/auto-doc/" + section,
            dom_id: '#swagger-ui',
            deepLinking: true,
            presets: [
                SwaggerUIBundle.presets.apis,
                SwaggerUIStandalonePreset
            ],
            plugins: [
                SwaggerUIBundle.plugins.DownloadUrl
            ],
            layout: "StandaloneLayout"
        })

        window.ui = ui
    }
</script>
</body>

</html>
