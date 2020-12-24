$(document).ready(function() {
  /*========== Sidebar user's agent open function ==========*/
  // $('.sidebar__profile__dropdown').click(function() {
  //   $('.sidebar .sidebar__agent-profile .sidebar__profile__dropdown-block').toggleClass('sidebar__profile__dropdown-block__opened');
  //   $('.sidebar .sidebar__agent-profile .sidebar__profile__dropdown').toggleClass('sidebar__profile__dropdown__opened');
  // });

  /*========== Small screen Sidebar open function ==========*/
  $('.main .navbar .nav .nav-item .nav-link .sidebar-toggler').click(function() {
    $('.sidebar').toggleClass('sidebar-opened');
  });

  /*========== User add course button open modal function ==========*/
  $('.main__content__agent-course-card .main__content__course-card__bottom__button').click(function() {
    $('.page__agent-course-modal').css("display", "block");
  });

  $('.page__agent-course-modal .page__course-modal__body__nav .page__course-modal__body__nav__link').click(function() {
    $('.page__agent-course-modal .page__course-modal__body__nav').css("display", "none");
    $('.page__agent-course-modal .page__course-modal__body__nav-2').css("display", "block");
  });

  $('.page__agent-course-modal .page__course-modal__body__nav-2 .page__course-modal__body__nav__link').click(function() {
    $('.page__agent-course-modal .page__course-modal__body__nav-2').css("display", "none");
    $('.page__agent-course-modal .page__course-modal__body__nav').css("display", "block");
    $('.page__agent-course-modal').css("display", "none");
    $('.main__content__agent-course-success').css("display", "flex");
    setTimeout(function(){
      $('.main__content__agent-course-success').css("display", "none");
    }, 3000);
  });

  /*========== User add course modal close button function ==========*/
  $('.page__agent-course-modal .fa-times').click(function() {
    $('.page__agent-course-modal').css("display", "none");
  });

  /*========== Course buy success modal close ==========*/
  $('.main__content__agent-course-success .main__content__course-success__right i').click(function() {
    $('.main__content__agent-course-success').css('display', 'none');
  });

  /*========== Agent My Portfels nav select change cards function ==========*/
  $('.main__content__agent-my-portfels-nav .main__content__portfels-nav__item-1').click(function() {
    if( !$(this).hasClass('active') ) {
      $(this).addClass('active');
      $('.main__content__agent-my-portfels-nav .main__content__portfels-nav__item-2').removeClass('active');
      $('.main__content .agent-my-portfels-1 > div').css('display', 'block');
      $('.main__content .agent-my-portfels-2 > div').css('display', 'none');
    }
  });

  /*========== Agent My Portfels nav select change cards function ==========*/
  $('.main__content__agent-my-portfels-nav .main__content__portfels-nav__item-2').click(function() {
    if( !$(this).hasClass('active') ) {
      $(this).addClass('active');
      $('.main__content__agent-my-portfels-nav .main__content__portfels-nav__item-1').removeClass('active');
      $('.main__content .agent-my-portfels-2 > div').css('display', 'block');
      $('.main__content .agent-my-portfels-1 > div').css('display', 'none');
    }
  });

  /*========== Portfels nav select change cards function ==========*/
  $('.main__content__agent-portfels-nav .main__content__portfels-nav__item-1').click(function() {
    if( !$(this).hasClass('active') ) {
      $(this).addClass('active');
      $('.main__content__agent-portfels-nav .main__content__portfels-nav__item-2').removeClass('active');
      $('.main__content .agent-portfels-1 > div').css('display', 'block');
      $('.main__content .agent-portfels-2 > div').css('display', 'none');
    }
  });

  /*========== Portfels nav select change cards function ==========*/
  $('.main__content__agent-portfels-nav .main__content__portfels-nav__item-2').click(function() {
    if( !$(this).hasClass('active') ) {
      $(this).addClass('active');
      $('.main__content__agent-portfels-nav .main__content__portfels-nav__item-1').removeClass('active');
      $('.main__content .agent-portfels-2 > div').css('display', 'block');
      $('.main__content .agent-portfels-1 > div').css('display', 'none');
    }
  });

  /*========== Portfels program add button click modal open ==========*/
  $('.main__content__agent-portfels-flex .main__content__portfels-flex__card__button').click(function() {
    $('.page .page__agent-program-modal').css("display", "block");
  });

  /*========== Portfels program add modal consultant choose open next modal ==========*/
  $('.page__agent-program-modal .page__program-modal__body__flex__item').click(function() {
    $('.page__agent-program-modal .page__program-modal__body').css("display", "none");
    $('.page__agent-program-modal .page__program-modal__body-2').css("display", "block");
  });

  /*========== Portfels program add second modal choose close modal ==========*/
  $('.page__agent-program-modal .page__program-modal__body-2 .page__program-modal__body-2__button').click(function() {
    $('.page__agent-program-modal .page__program-modal__body-2 .page__program-modal__body-2__input').val("");
    $('.page__agent-program-modal').css("display", "none");
    $('.page__agent-program-modal .page__program-modal__body').css("display", "block");
    $('.page__agent-program-modal .page__program-modal__body-2').css("display", "none");
    $('.main__content__agent-program-success').css("display", "flex");
    setTimeout(function(){
      $('.main__content__agent-program-success').css("display", "none");
    }, 3000);
  });

  /*========== Agent add program modal close button function ==========*/
  $('.page__agent-program-modal .fa-times').click(function() {
    $('.page__agent-program-modal').css("display", "none");
    $('.page__agent-program-modal .page__program-modal__body').css("display", "flex");
    $('.page__agent-program-modal .page__program-modal__body-2').css("display", "none");
  });

  /*========== Portfel buy modal input button active ==========*/
  $( ".page__agent-program-modal .page__program-modal__body-2 .page__program-modal__body-2__input" ).keyup(function() {
    if ($(this).val() != "") {
      $('.page__agent-program-modal .page__program-modal__body-2 .page__program-modal__body-2__button').addClass('active');
    } else {
      $('.page__agent-program-modal .page__program-modal__body-2 .page__program-modal__body-2__button').removeClass('active');
    }
  });

  /*========== Portfel buy success modal close ==========*/
  $('.main__content__agent-program-success i').click(function() {
    $('.main__content__agent-program-success').css('display', 'none');
  });

  /*========== Agent but course button open modal function ==========*/
  $('.main__content__agent-card__bottom__button').click(function() {
    $('.page__agent-modal').css("display", "block");
  });

  /*========== Agent modal close button function ==========*/
  $('.page__agent-modal .fa-times').click(function() {
    $('.page__agent-modal').css("display", "none");
  });

  /*========== Agent agree requirements function ==========*/
  $("#page__agent-modal__body__checkbox").change(function() {
    if(this.checked) {
      $(".page__agent-modal__body__button").addClass('enabled');
    } else {
      $(".page__agent-modal__body__button").removeClass('enabled');
    }
  });

  $('.panel-agent').click(function() {
    jQuery(this).find("svg").toggleClass('opened');
  })

  /*========== Agent settings history of sellings open modal function ==========*/
  $('.main__content__agent-settings-flex .main__content__settings-flex__comission__btn-1').click(function() {
    $('.page__agent-settings-program-modal').css("display", "block");
  });

  /*========== Agent settings history of sellings modal close button function ==========*/
  $('.page__agent-settings-program-modal .fa-times').click(function() {
    $('.page__agent-settings-program-modal').css("display", "none");
  });

  /*========== Agent settings notification modal ==========*/
  // $('.main__content__agent-settings-flex .main__content__settings-flex__comission__btn-1').click(function() {
  //     $('.page__agent-settings-program-modal').css("display", "block");
  // });

  /*========== Agent settings notification modal close button function ==========*/
  $('.page__agent-settings-program-modal-2 .fa-times').click(function() {
    $('.page__agent-settings-program-modal-2').css("display", "none");
  });

  /*========== Agent settings not available modal close button function ==========*/
  $('.page .page__agent-settings-not-available-program-modal .fa-times').click(function() {
    $('.page .page__agent-settings-not-available-program-modal').css("display", "none");
  });

  /*========== Agent settings success modal close ==========*/
  $('.main__content__agent-settings-success i').click(function() {
    $('.main__content__agent-settings-success').css('display', 'none');
  });

  $('.sidebar-toggler').click(function() {
    if ($('.page .sidebar').hasClass('sidebar-opened')) {
      $('.main').css({'height' : '100%', 'overflow-y' : 'hidden'});
    } else {
      $('.main').css({'height' : 'auto', 'overflow-y' : 'scroll'});
    }
  });

});