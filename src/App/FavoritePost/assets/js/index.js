jQuery(function (e) {
    // 'max-age' :3600 //  альтернатива expires

    const favoriteConfig = {
         expires:   new Date(Date.now() + 3600 * 24 * 30 )   , // about month
         maxAge :3600 ,  // если задать это вместо expires  то будет считать секунды с этого момента
        cookieName: 'alex_material_favorite',
        thumbnailAndIconWrapperClass: 'alex-favorite-thumbnail-wrapper',
         wrapperIconClass: 'alex-favorite-icon-wrapper', // class for find favorite icon
        wrapperIconAddTitle : '',
        wrapperIconRemoveTitle : 'Убрать из любимых',
        activeClass: 'alex-favorite', // class for change style,

        dataIdKey: 'material_id',

        wrapperButtonClass: 'alex-favorite-btn-wrapper',
        wrapperButtonFullTitle: 'Нажмите что бы посмотерь избранные',
        wrapperButtonEmptyTitle: 'Вы еще не ничего не выбрали',
        wrapperButtonStartHref: '/material?page=favorite&post_ids='
    };



    // get all icon
    const allIcon = jQuery(`.${favoriteConfig.wrapperIconClass}`);
    if(allIcon.length <  1 ){
        return false;
    }

    // get page btn
    const favoriteButton = jQuery(`.${favoriteConfig.wrapperButtonClass}`);
    if(favoriteButton.length < 1){
        return false;
    }

    // set favorite values

    // get start cookies - in array
    let cookies = getCookie(favoriteConfig.cookieName);
    if(!cookies){
        cookies = [];
    }else{
        cookies = JSON.parse(cookies);
    }
    //========
    // set button data
    if(cookies.length){
        favoriteButton
            .attr('href' , `${favoriteConfig.wrapperButtonStartHref}${cookies.join( '-' )}`  )
            .attr('title' , favoriteConfig.wrapperButtonFullTitle)
            .addClass(favoriteConfig.activeClass);

    }else{
        favoriteButton
            .attr('href' , `#`  )
            .attr('title' , favoriteConfig.wrapperButtonEmptyTitle);

    }

    // set icons data
    allIcon.each( function (){

        const id = jQuery(this).data(favoriteConfig.dataIdKey);
        if(cookies.includes(id)){
                jQuery(this)
                    .addClass(favoriteConfig.activeClass)
                    .attr('title' , favoriteConfig.wrapperIconRemoveTitle);
            }
        }

    );
    // end set values ===================================

    // add to favorite and remove form favorite
    allIcon.each(function () {
        const currentIcon =  jQuery(this) ;
        const id  = Number(currentIcon.data(favoriteConfig.dataIdKey) );
        currentIcon.on('click' , function (e){
            e.preventDefault();

            if(currentIcon.hasClass(favoriteConfig.activeClass)){
                currentIcon
                    .removeClass(favoriteConfig.activeClass)
                    .attr('title' , favoriteConfig.wrapperIconAddTitle );

                // remove id to cookie here
                cookies = cookies.filter((item)=> Number(item) !== id);

            }else{
                currentIcon
                    .addClass(favoriteConfig.activeClass)
                    .attr('title' , favoriteConfig.wrapperIconRemoveTitle);

                // add id to cookies here
                cookies = [ ...cookies , id];
            }
            //handler Btn here add cookie to href and title
            if(cookies.length){
                favoriteButton
                .attr('href' , `${favoriteConfig.wrapperButtonStartHref}${cookies.join( '-' )}`  )
                .attr('title' , favoriteConfig.wrapperButtonFullTitle)
                .addClass(favoriteConfig.activeClass);
            }else{
                favoriteButton
                    .attr('href' , `#`  )
                    .attr('title' , favoriteConfig.wrapperButtonEmptyTitle)
                    .removeClass(favoriteConfig.activeClass);
            }

            //=================================

            let cookiesJson = JSON.stringify(cookies);

            //set cookies to browser
            let options = { expires: favoriteConfig.expires};
            // let options = {'max-age': favoriteConfig.maxAge};
            setCookie( favoriteConfig.cookieName , cookiesJson, options );
            //{expires: favoriteConfig.expires}
        });
    });
    //========================
})

//--- cookies function ----------------------------------------
// возвращает куки с указанным name,
// или undefined, если ничего не найдено
function getCookie(name) {
    let matches = document.cookie.match(new RegExp(
        "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
    ));
    return matches ? decodeURIComponent(matches[1]) : undefined;
}

function setCookie(name, value, options = {}) {

    options = {
        path: '/',
        // при необходимости добавьте другие значения по умолчанию
        ...options
    };

    if (options.expires instanceof Date) {
        options.expires = options.expires.toUTCString();
    }

    let updatedCookie = encodeURIComponent(name) + "=" + encodeURIComponent(value);

    for (let optionKey in options) {
        updatedCookie += "; " + optionKey;
        let optionValue = options[optionKey];
        if (optionValue !== true) {
            updatedCookie += "=" + optionValue;
        }
    }

    document.cookie = updatedCookie;
}

// Пример использования:
// setCookie('user', 'John', {secure: true, 'max-age': 3600});
// setCookie(cookieName , [].join(',') ,{secure: true, 'max-age': 3600} ); secure ?? do not work with
//========END cookies functions ============================================================