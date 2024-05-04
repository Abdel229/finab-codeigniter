
$(document).ready(function(){

    window.addEventListener("scroll", () => {
        // HEADER ACTIVE
        const windowHeight = window.scrollY
        const header = document.querySelector("header.header")
        if(header){
          if(windowHeight > 121){
            if(!header.classList.contains('active')){
              header.classList.add('active')
            }
          }else{
            if(header.classList.contains('active')){
              header.classList.remove('active')
            }
          }
        }
      
    })
      
    const  btnMenu = document.getElementById("js-btn-menu")
    if(btnMenu){
        const headerMenuMobile = document.getElementById("header-menu")
        btnMenu.addEventListener('click', e=>{
            e.preventDefault()
            if(btnMenu.classList.contains('active')){
                btnMenu.classList.remove('active')
            }else{
                btnMenu.classList.add('active')
            }
            if(headerMenuMobile.classList.contains('active')){
                headerMenuMobile.classList.remove('active')
            }else{
                headerMenuMobile.classList.add('active')
            }
        })
    }

    //distinction
    $('.js-distinction').slick({
        dots:true,
        slidesToShow: 4,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 8000,
        responsive: [
            {
                breakpoint: 992,
                settings: {
                slidesToShow: 3,
                slidesToScroll: 1,
                }
            },
            {
                breakpoint: 691,
                settings: {
                slidesToShow: 2,
                slidesToScroll: 1,
                }
            },
            {
                breakpoint: 495,
                settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                }
            },
        ],
    })

    $('.js-partner').slick({
        dots:false,
        slidesToShow: 6,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        responsive: [
            {
                breakpoint: 992,
                settings: {
                slidesToShow: 5,
                slidesToScroll: 1,
                }
            },
            {
                breakpoint: 767,
                settings: {
                slidesToShow: 4,
                slidesToScroll: 1,
                }
            },
            {
                breakpoint: 595,
                settings: {
                slidesToShow: 2,
                slidesToScroll: 1,
                }
            },
        ],
    })

    $('.js-event').slick({
        dots:false,
        centerMode: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 8000,
        responsive: [
            {
                breakpoint: 992,
                settings: {
                slidesToShow: 2,
                slidesToScroll: 1,
                }
            },
            {
                breakpoint: 768,
                settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                }
            },
        ], 
    })

    //fancibox
    $('[data-fancybox="gallery"]').fancybox({});

    /*=====================================
    * ==========PROGRAMME PAGE ============
    * ====================================*/
    //dynamic list program
    const selectField = document.getElementById('programmeSearch')
    const allProgram = document.querySelectorAll('.programme-box__bottom__item')
    const programListBox = document.getElementById('programmeList')
    //:01 -> set current day program
    const currentDate = new Date()
    const currentDateMonth = currentDate.getMonth() < 9 ? ('0'+(currentDate.getMonth()+1)):(currentDate.getMonth()+1)
    const currentDateDay = currentDate.getDate() < 9 ? ('0' + currentDate.getDate()) : currentDate.getDate()
    const currentDateFormatted = `${currentDateDay}-${currentDateMonth}-${currentDate.getFullYear()}`

    allProgram.forEach(item => {
        item.classList.remove('active')
        if(item.hasAttribute('data-fancybox')){
            item.removeAttribute('data-fancybox')
        }
    })
    const currentDateProgram = document.querySelectorAll(`.programme-box__bottom__item[data-day="${currentDateFormatted}"]`)
    if(currentDateProgram.length>0){
        currentDateProgram.forEach(item =>{
            item.classList.add('active')
            item.setAttribute('data-fancybox', currentDateFormatted)
        })
        $(`[data-fancybox="${currentDateFormatted}"]`).fancybox({});

    }
    //:02-> set current date in option tag
    const optionTag = selectField.querySelectorAll('option')
    if(optionTag){
        optionTag.forEach(item => item.value===currentDateFormatted?item.setAttribute('selected','selected'):item.removeAttribute('selected'))
    }

    //set
    if(selectField){
        selectField.onchange = function(e){
            let value = e.target.value

            const allCurrentProgram = document.querySelectorAll(`.programme-box__bottom__item[data-day="${value}"]`)

            programListBox.classList.remove('empty')
            
            allProgram.forEach(item => {
                item.classList.remove('active')
                if(item.hasAttribute('data-fancybox')){
                    item.removeAttribute('data-fancybox')
                }
            })

            if(allCurrentProgram.length>0){
                allCurrentProgram.forEach(item =>{
                    item.classList.add('active')
                    item.setAttribute('data-fancybox', value)
                })
                $(`[data-fancybox="${value}"]`).fancybox({});

            }else{
                if(programListBox.classList.contains('empty')){
                    programListBox.classList.remove('empty')
                }
                programListBox.classList.add('empty')
            }

        }
    }
    
})

const wow = new WOW({
  boxClass:     'wow',      // animated element css class (default is wow)
  animateClass: 'animated', // animation css class (default is animated)
  offset:       0,          // distance to the element when triggering the animation (default is 0)
  mobile:       true,       // trigger animations on mobile devices (default is true)
  live:         true,       // act on asynchronously loaded content (default is true)
  callback:     function(box) {
    // the callback is fired every time an animation is started
    // the argument that is passed in is the DOM node being animated
  },
  scrollContainer: null,    // optional scroll container selector, otherwise use window,
  resetAnimation: true,     // reset animation on end (default is true)
});
wow.init();




// const ytTag = document.createElement('script');
// ytTag.src = "https://www.youtube.com/player_api";
// const firstScriptTag = document.getElementsByTagName('script')[0];
// firstScriptTag.parentNode.insertBefore(ytTag, firstScriptTag);
// let player
// const onYouTubePlayerAPIReady = () => {
//     player = new YT.Player('ytplayer', {
//         height: '360',
//         width: '640',
//         videoId: 'M7lc1UVf-VE'
//       })
// }
// onYouTubePlayerAPIReady()