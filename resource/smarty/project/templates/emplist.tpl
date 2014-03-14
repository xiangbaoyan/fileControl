<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
</head>
<body>
    {foreach from=$emplist item=emp }
        {foreach from=$emp item=value key=key}
            {if $key != 'age'}
                <span style="color: red">{$key}</span>
                <span style="color: green">{$value}</span>
                <br>
            {/if}
        {/foreach}
    {/foreach}
</body>
</html>