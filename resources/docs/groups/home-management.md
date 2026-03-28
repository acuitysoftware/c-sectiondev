# Home Management

APIs for managing basic auth functionality

## api/site-settings




> Example request:

```javascript
const url = new URL(
    "http://localhost/c-section/api/site-settings"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "POST",
    headers,
}).then(response => response.json());
```


> Example response (200):

```json
{
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
}
```
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



