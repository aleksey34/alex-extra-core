jQuery(function (e) {
    const favoriteConfig = {
        liftTime: 3600, // 1 hour
        cookieName: 'alex_material_favorite',
        iconClasses: 'page-header-title', // class for find favorite icon
        cssClasses: 'button any-name-class', // class for change style
        bodyClasses: 'single-material' , //body classes  for get post id  - need find class - postid-{number}
    };


    const materialBody = jQuery(`body.${favoriteConfig.bodyClasses}`); // body of page

    // icon or any img etc need! element for click to toggle to favorite
    const singleMaterialFavoriteIcon = materialBody.find(`.${favoriteConfig.iconClasses}`);

    let isFavorite = false;


    let currentCookie = getCookie(favoriteConfig.cookieName);

    if(materialBody.length && singleMaterialFavoriteIcon.length){

        const materialId  = getMaterialId();

        let currentCookieArr = [];

        if(!currentCookie){
            isFavorite  = false;
            setCookie(favoriteConfig.cookieName , JSON.stringify([] ) ,{'max-age': favoriteConfig.liftTime} );
        }else{
            currentCookieArr = JSON.parse(currentCookie );

            currentCookieArr.includes(materialId) ? isFavorite = true : isFavorite = false;

            // check favorite here
        }

        isFavorite ?
            singleMaterialFavoriteIcon.addClass(favoriteConfig.cssClasses) :
            singleMaterialFavoriteIcon.removeClass(favoriteConfig.cssClasses) ;

        singleMaterialFavoriteIcon.on('click' , function (e){

// set or remove from favorite  - here!
            isFavorite = !isFavorite;
            if(isFavorite){
                currentCookieArr  = [...currentCookieArr , materialId];
                setCookie(favoriteConfig.cookieName , JSON.stringify(currentCookieArr) ,{'max-age': favoriteConfig.liftTime} );

            }else{
                currentCookieArr = currentCookieArr.filter( ( item) => ( item !== materialId ))
                setCookie(favoriteConfig.cookieName , JSON.stringify(currentCookieArr) ,{'max-age': favoriteConfig.liftTime} );
            }
//
            isFavorite ?
                singleMaterialFavoriteIcon.addClass(favoriteConfig.cssClasses) :
                singleMaterialFavoriteIcon.removeClass(favoriteConfig.cssClasses) ;

        });


        function  getMaterialId (){
            let id = '';
            const classNames = materialBody.attr('class');
            const classNamesArr = [ ...classNames.split(' ') ];

            classNamesArr.forEach((e) =>{

                const eArr = e.split('-');
                if(eArr.length === 2 && eArr[0] === 'postid'){
                    id  =  eArr[1];
                }

            });

            return Number(id);

        }


        function setFavoriteButtonHref(cookieStr){
            //add href query here


            // end add href query
        }


    }



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