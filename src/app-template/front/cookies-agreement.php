<?php  if(!is_user_logged_in()) : ?>
<div class="alex-cookies-notice-agreement  hidden">
	Мы используем куки для наилучшего представления нашего сайта. Если Вы продолжите использовать сайт, мы будем считать что Вас это устраивает.
	<button class="alex-cookie-notice-btn">Согласен</button>
</div>
<style>
    .alex-cookies-notice-agreement {
        background: #444;
        color: #fff;
        padding: 6px;
        font-size: 13px;
        text-align: center;
        position: fixed;
        bottom: 0;
        width: 100%;
        z-index: 10;
    }
    .alex-cookies-notice-agreement.hidden {
        display: none;
    }

    .alex-cookies-notice-agreement button {
        text-decoration: none;
        background: #222;
        color: #fff;
        border: 1px solid #000;
        cursor: pointer;
        padding: 4px 7px;
        margin: 2px 0;
        font-size: 1rem;
        font-weight: 700;
        transition: background 0.07s, color 0.07s, border-color 0.07s;
    }

    .alex-cookies-notice-agreement button:hover {
        transition: background 0.07s, color 0.07s, border-color 0.07s;
        background: #fff;
        color: #222;
    }
</style>
<script type="text/javascript">
    (function (){

        const getCookie = (name) => {
            const value = " " + document.cookie;
            // console.log("value", `==${value}==`);
            const parts = value.split(" " + name + "=");
            return parts.length < 2 ? undefined : parts.pop().split(";").shift();
        };

        const setCookie = function (name, value, expiryDays, domain, path, secure) {
            const exdate = new Date();
            exdate.setHours(
                exdate.getHours() +
                (typeof expiryDays !== "number" ? 365 : expiryDays) * 24
            );
            document.cookie =
                name +
                "=" +
                value +
                ";expires=" +
                exdate.toUTCString() +
                ";path=" +
                (path || "/") +
                (domain ? ";domain=" + domain : "") +
                (secure ? ";secure" : "");
        };


        (() => {
            const $cookiesBanner = document.querySelector(".alex-cookies-notice-agreement");
            const $cookiesBannerButton = $cookiesBanner.querySelector("button");

            $cookiesBannerButton.addEventListener("click", () => {
                $cookiesBanner.remove();
            });
        })();


        const $cookiesBanner = document.querySelector(".alex-cookies-notice-agreement");
        const $cookiesBannerButton = $cookiesBanner.querySelector("button");
        const cookieName = "alex_cookies_banner";
        const hasCookie = getCookie(cookieName);

        if (!hasCookie) {
            $cookiesBanner.classList.remove("hidden");
        }

        $cookiesBannerButton.addEventListener("click", () => {
            setCookie(cookieName, "accept_cookies");
            $cookiesBanner.remove();
        });
    })();
</script>
<?php endif;