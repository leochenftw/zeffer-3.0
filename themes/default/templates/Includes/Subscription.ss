<form v-if="!completed" class="subscription-form" method="post" action="/api/v/1/subscribe">
    <div class="field is-horizontal">
        <div class="field-body" v-if="lang == 'en-NZ'">
            <div class="field">
                <div class="control">
                    <input class="input is-large" type="text" name="FirstName" required placeholder="First Name">
                </div>
            </div>
            <div class="field">
                <div class="control">
                    <input class="input is-large" type="text" name="LastName" required placeholder="Last Name">
                </div>
            </div>
            <div class="field">
                <div class="control">
                    <input class="input is-large" type="email" name="Email" required placeholder="Email">
                </div>
            </div>
            <div class="field subscription-form__action">
                <div class="control">
                    <button class="button is-info icon" type="submit"><i class="fa fa-envelope"></i> Subscribe</button>
                </div>
            </div>
        </div>
        <div class="field-body" v-else>
            <div class="field">
                <div class="control">
                    <input class="input is-large" type="text" name="LastName" required placeholder="姓">
                </div>
            </div>
            <div class="field">
                <div class="control">
                    <input class="input is-large" type="text" name="FirstName" required placeholder="名">
                </div>
            </div>
            <div class="field">
                <div class="control">
                    <input class="input is-large" type="email" name="Email" required placeholder="电子邮件">
                </div>
            </div>
            <div class="field subscription-form__action">
                <div class="control">
                    <button class="button is-info icon" type="submit"><i class="fa fa-envelope"></i> 订阅</button>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" name="csrf" :value="csrf" />
</form>
<div v-else class="notification is-success" v-html="message"></div>
