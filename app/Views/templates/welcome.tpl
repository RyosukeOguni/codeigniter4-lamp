<html lang="ja">
<head>
    {{* https://developer.mozilla.org/ja/docs/Learn/HTML/Introduction_to_HTML/The_head_metadata_in_HTML *}}
    <meta charset="UTF-8">
    {{include 'parts/head/custom-meta.tpl'}}
    <title>{{$title}}</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    {{include 'parts/head/common-css.tpl'}}
    {{* custom CSS: start *}}
    {{* custom CSS: end *}}
</head>
<body>
{{* body: start *}}
<h1>{{$message}}</h1>
<p>Session count: {{$sessionCount|number_format}}</p>
{{$_form.open_tag nofilter}}
<label>
    <input type="text" name="field1" value="value1">
</label>
<label>
    <input type="text" name="field2" value="value2">
</label>
<label>
    <input type="text" name="field3" value="value3">
</label>
<input type="submit">
{{$_form.close_tag nofilter}}
{{* body: end *}}
</body>
{{* before common scripts: start *}}
{{* before common scripts: end *}}
{{include 'parts/foot/common-scripts.tpl'}}
{{* after common scripts: start *}}
<script>
    const xhr = new XMLHttpRequest();
    xhr.open('POST', '//other.codeigniter.example.com/api/post-here');
    xhr.setRequestHeader('X-API-KEY', 'some-key');
    xhr.setRequestHeader('Content-Type', 'application/xml');
    xhr.onreadystatechange = function () {
    };
    xhr.send('<person><name>Arun</name></person>');
</script>
{{* after common scripts: end *}}
</html>
