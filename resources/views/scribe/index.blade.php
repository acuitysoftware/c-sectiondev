<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Laravel 8 Documentation</title>

    <link href="https://fonts.googleapis.com/css?family=PT+Sans&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="{{ asset("vendor/scribe/css/style.css") }}" media="screen" />
        <link rel="stylesheet" href="{{ asset("vendor/scribe/css/print.css") }}" media="print" />
        <script src="{{ asset("vendor/scribe/js/all.js") }}"></script>

        <link rel="stylesheet" href="{{ asset("vendor/scribe/css/highlight-darcula.css") }}" media="" />
        <script src="{{ asset("vendor/scribe/js/highlight.pack.js") }}"></script>
    <script>hljs.initHighlightingOnLoad();</script>

</head>

<body class="" data-languages="[&quot;javascript&quot;]">
<a href="#" id="nav-button">
      <span>
        NAV
            <img src="{{ asset("vendor/scribe/images/navbar.png") }}" alt="-image" class=""/>
      </span>
</a>
<div class="tocify-wrapper">
                <div class="lang-selector">
                            <a href="#" data-language-name="javascript">javascript</a>
                    </div>
        <div class="search">
        <input type="text" class="search" id="input-search" placeholder="Search">
    </div>
    <ul class="search-results"></ul>

    <ul id="toc">
    </ul>

            <ul class="toc-footer" id="toc-footer">
                            <li><a href="{{ route("scribe.postman") }}">View Postman collection</a></li>
                            <li><a href="{{ route("scribe.openapi") }}">View OpenAPI (Swagger) spec</a></li>
                            <li><a href='http://github.com/knuckleswtf/scribe'>Documentation powered by Scribe ✍</a></li>
                    </ul>
            <ul class="toc-footer" id="last-updated">
            <li>Last updated: March 24 2025</li>
        </ul>
</div>
<div class="page-wrapper">
    <div class="dark-box"></div>
    <div class="content">
        <h1>Introduction</h1>
<p>This documentation aims to provide all the information you need to work with our API.</p>
<aside>As you scroll, you'll see code examples for working with the API in different programming languages in the dark area to the right (or as part of the content on mobile).
You can switch the language used with the tabs at the top right (or from the nav menu at the top left on mobile).</aside>
<script src="https://cdn.jsdelivr.net/npm/lodash@4.17.10/lodash.min.js"></script>
<script>
    var baseUrl = "http://localhost:8000";
</script>
<script src="{{ asset("vendor/scribe/js/tryitout-2.4.2.js") }}"></script>
<blockquote>
<p>Base URL</p>
</blockquote>
<pre><code class="language-yaml">http://localhost:8000</code></pre><h1>Authenticating requests</h1>
<p>This API is not authenticated.</p><h1>Home Management</h1>
<p>APIs for managing basic auth functionality</p>
<h2>api/site-settings</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost/c-section/api/site-settings"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "status": true,
    "data": {
        "id": 1,
        "logo": "images\/1697115559-6211.png",
        "footer_logo": null,
        "header_text": null,
        "footer_text": null,
        "address": "kolkata",
        "address_2": null,
        "email": "animeshmondal832@gmail.com",
        "email_2": null,
        "phone": "9876543210",
        "phone_2": null,
        "order_link": "https:\/\/www.google.com\/",
        "google_link": null,
        "razor_pay_key": "rzp_test_AlckoYRzH7ONlI",
        "razor_pay_secret": "AVsveQ6ZiIIuVLNchhsdsMZw",
        "reward_points": "10",
        "reward_points_to_inr": "5",
        "android_app_link": null,
        "ios_app_link": null,
        "google_recaptcha_key": "6LeNIu8mAAAAAHT9pJUEYmRZ71S15oXLhSruWF_w",
        "google_recaptcha_secret": "6LeNIu8mAAAAAIBh2KUjISnPSOqQ3cBbLyh-0O81",
        "map": null,
        "opening_hour": null,
        "login_link": "http:\/\/localhost\/c-section\/admin\/cms\/term-and-conditions",
        "signup_link": "http:\/\/localhost\/c-section\/admin\/cms\/term-and-conditions",
        "privacy_policy_link": "http:\/\/localhost\/c-section\/admin\/cms\/term-and-conditions",
        "term_condition_link": "http:\/\/localhost\/c-section\/admin\/cms\/term-and-conditions",
        "contact_link": "http:\/\/localhost\/c-section\/admin\/cms\/term-and-conditions",
        "created_at": "2023-10-09T07:56:10.000000Z",
        "updated_at": "2025-03-24T07:08:26.000000Z"
    }
}</code></pre>
<div id="execution-results-POSTapi-site-settings" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-site-settings"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-site-settings"></code></pre>
</div>
<div id="execution-error-POSTapi-site-settings" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-site-settings"></code></pre>
</div>
<form id="form-POSTapi-site-settings" data-method="POST" data-path="api/site-settings" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-site-settings', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-site-settings" onclick="tryItOut('POSTapi-site-settings');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-site-settings" onclick="cancelTryOut('POSTapi-site-settings');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-site-settings" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/site-settings</code></b>
</p>
</form>
    </div>
    <div class="dark-box">
                    <div class="lang-selector">
                                    <a href="#" data-language-name="javascript">javascript</a>
                            </div>
            </div>
</div>
<script>
    $(function () {
        var languages = ["javascript"];
        setupLanguages(languages);
    });
</script>
</body>
</html>