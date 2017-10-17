// ON DOCUMENT LOAD FUNCTIONS ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

$(document).ready(function () {

  $('#fullpage').fullpage({ // FULLPAGE SCROLLING JQUERY PLUG-IN
    navigation: true,
    scrollOverflow: true,
  });

  $('.ani-opt, #fontSize, textarea, .ani-wrap, .limit').mouseover(function () { // PREVENTS FULLPAGE SCROLL WHEN FOCUSED
    $.fn.fullpage.setAllowScrolling(false);
  })
  $('.ani-opt, #fontSize, textarea, .ani-wrap, .limit').mouseout(function () { // REACTIVATES FULLPAGE SCROLL WHEN FOCUSED
    $.fn.fullpage.setAllowScrolling(true);
  })

  setTimeout(function () { //LOADS EXTERNAL HTML FILES
    $('#delayLoad').load('includes/animate-code.html');
    $('#pull').load('includes/animatecss.html');
    $('#my-ani').load('includes/jack-ani.html');
    $('#fontSize').load('includes/fontsizes.html');
  }, 800);

  //DOCUMENT READY DEFAULT VALUES

  var aniTime = $('.sliderDur').val();
  var secondText = '\n.animate {\n  animation-duration: ' + aniTime + 's;\n}';
  var fontSize = $('#fontSize').val();

  $('.object').css('animation-duration', '1s');
  $('#code').append(secondText);
  $('.text').css('font-size', fontSize + 'px');

  $('.select-txt').click(function () { // INCASE THEY CLICK ON SELECT WITHOUT SWITCHING TAB
    $('.select-content').select();
  });

  $('.clipboard').click(function () {
    $('#code').select();
  });

  $('.tab-switch').click(function () { // NOTICES CHANGE IN TAB AND ALLOWS THE SELECTION OF
    $('.select-txt').click(function () {
      $('.select-content').select();
    });
  });
  $('div.first:first-child').attr('aria-hidden', false);
  $('li.first:first-child').addClass('is-active');
  $('div.first:first-child').addClass('is-active');
  $('.canvas-opt').hide();
  $('.save-box').hide();
});

// REPLAY BUTTON & SELECT BOX ANIMATION CHANGE ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

function move() {
  var elem = document.getElementById('myBar');
  var width = 0;
  var time = $('.sliderDur').val() * 10;
  var id = setInterval(frame, time);

  function frame() {
    if (width >= 100) {
      console.log('reset');
      clearInterval(id);

      // elem.style.width = '0%';
    } else {
      width++;
      elem.style.width = width + '%';
    }
  }
}

function testAnim(x) {

  if ($('#tArea').hasClass('text')) { //CHECKS IF TEXT OR SQUARE
    console.log('I have class text');
    $('#tArea').removeClass().addClass(x + ' animate text').one(
      'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend',
      function () {
        console.log('text function fired');
        $(this).removeClass().addClass('object text');
      });
  }
  if ($('#cArea').hasClass('myCanvas')) { //CHECKS IF CANVAS
    console.log('I have class myCanvas');
    $('.canvas-wrap').removeClass().addClass(x + ' animate object').one(
      'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend',
      function () {
        console.log('myCanvas function fired');
        $(this).removeClass().addClass('object canvas-wrap obj-wrap');
      });
  } else {
    var shape = $('#shape').val();
    $('#area').removeClass().addClass(x + ' animate ' + shape).one(
      'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend',
      function () {
        $(this).removeClass().addClass('object ' + shape);
      });
  }
}

$(document).ready(function () {
  $('.play').click(function (e) { //PLAY BUTTON
    e.preventDefault();
    var anim = $('.ani-opt').val();
    testAnim(anim);
    move();
  });

  $('.ani-opt').change(function () { //SELECT BOX
    var anim = $(this).val();
    var aniTime = $('.sliderDur').val();
    var secondText = '\n.animate {\n  animation-duration: ' + aniTime + 's;\n}';
    var modalCode = $('div#code-' + anim).text();

    // console.log(modalCode);

    testAnim(anim);

    $('#class').text('.' + anim + ' ');
    $('#code').text(modalCode + secondText);
  });

  //TEXT INPUT & OPTIONS BOX ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

  $('#textor').keyup(function () {
    var defaultDur = 'style="animation-duration: ' + $('.sliderDur').val() + 's;"';

    $('.optionOne').addClass('none');
    $('.clear-appear').fadeOut(300);
    $('.canvas-opt').fadeOut(300);
    $('#hide-on-canvas').slideDown(300);

    if ($.trim($(this).val()).length == 0) {

      $('.optionOne').removeClass('none');
      $('.optionTwo').addClass('none');
      $('.obj-wrap').html('<div id="area"' + defaultDur +
        ' class="object square animate"></div>');
    } else {
      $('.optionTwo').removeClass('none');
      $('.obj-wrap').html('<div id="tArea"' + defaultDur + ' class="object text animate">' +
        $(this).val() +
        '</div>');
    }
  });

  $('#back').click(function () {
    var defaultDur = 'style="animation-duration: ' + $('.sliderDur').val() + 's;"';
    var shape = $('#shape').val();
    $('#textor').val(''); // MAKES INPUT FIELD EMPTY
    $('.optionOne').removeClass('none'); // MAKES OPTION BOX 1 APPEAR AGAIN
    $('.optionTwo').addClass('none'); // HIDES THE TEXT OPTION BOX
    $('.obj-wrap').html('<div id="area"' + defaultDur +
      ' class="object ' + shape + ' animate"></div>'); // SWAPS OUT THE ANIMATED OBJECT ON THE CANVAS
  });

  $('#bold').click(function () {
    $('.text').toggleClass('bold');
  });
  $('#uppercase').click(function () {
    $('.text').toggleClass('upper');
  });
  $('#italics').click(function () {
    $('.text').toggleClass('italics');
  });
});

$('#fontSize').change(function () {
  var newSize = $(this).val();

  $('div.text').css('font-size', newSize + "px");
});

$('#font').change(function () {
  var newFont = $(this).val();

  $('div.text').css({
    'font-family': newFont
  });
});

$('#lorem').click(function () {
  var dummy =
    "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";

  $('#textor').val('');
  $('.text').html(dummy);
  $('.text').css('margin', '5% auto 0');
});

$('#fontWidth').on('input', function () {
  var width = $(this).val();

  $('#fontWidthVal').val(width);
  $('.text').css('width', width + "%");
});

$('#fontWidthVal').keyup(function () {
  var width = $(this).val();

  $('#fontWidth').val(width);
  $('.text').css('width', width + "%");
});

// SHAPES SELECT BOX ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

$('#shape').change(function () {
  var shape = $(this).val();
  var color = $('#colorPicker').val();
  var defaultDur = 'style="animation-duration: ' + $('.sliderDur').val() + 's;"';

  $('.obj-wrap').html('<div id="area" ' + defaultDur +
    ' class="object square animate"></div>');

  $('#area').removeClass().addClass('object animate ' + shape);

  if ($('#shape option:selected').val() == 'square') {
    $('.square').css('background', color);
    console.log('square has been detected');
  }
  if ($('#shape option:selected').val() == 'circle') {
    $('.circle').css('background', color);
    console.log('circle has been detected');
  }
  if ($('#shape option:selected').val() == 'diamond') {
    $('.diamond').css('background', color);
    console.log('circle has been detected');
  }
  if ($('#shape option:selected').val() == 'rombus') {
    $('.rombus').css('background', color);
    console.log('circle has been detected');
  } else {
    console.log('Triangle is firing');
    $('.triangle').css('background', 'transparent');
    $('.triangle').css('border-bottom-color', color);
  }
});

//COLOR PICKER ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

$('#colorPicker').on('input', function () {
  var color = $(this).val();

  $('.square').css('background', color);
  $('.triangle').css('border-bottom-color', color);
  $('.circle').css('background', color);
  $('.diamond').css('background', color);
  $('.rombus').css('background', color);
  $('#colorVal').val(color);
  $(this).css('background', color);
});

$('#colorVal').keyup(function () {
  var color = $(this).val();

  $('#colorPicker').val(color);
  $('.square').css('background', color);
  $('.triangle').css('border-bottom-color', color);
  $('.circle').css('background', color);
  $('.diamond').css('background', color);
  $('.rombus').css('background', color);
});

// SLIDERS ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

$('.sliderDur').on('input', function () { //ANIMATION DURATION SLIDER
  var aniTime = $(this).val();
  var anim = $('.ani-opt').val();
  var preAniTime = '\n.animate {\n  animation-duration: ' + aniTime + 's;\n}';
  var modalCode = $('div#code-' + anim).text();

  $('div.object').css('animation-duration', aniTime + 's');
  $('#code').text(modalCode + preAniTime);
  $('#textDurVal').val(aniTime);
});

$('.sliderDurVal').keyup(function () { //INPUT BOX SLIDER VAL
  var inputTime = $(this).val();
  var anim = $('.ani-opt').val();
  var preAniTime = '\n.animate {\n  animation-duration: ' + inputTime + 's;\n}';
  var modalCode = $('div#code-' + anim).text();

  $('div.object').css('animation-duration', inputTime + 's');
  $('#code').text(modalCode + preAniTime);
});

$('#width').on('input', function () { //WIDTH OF OBJECT (SQUARE)
  var width = $(this).val();
  var height = ($('#height').val());
  var select = $('#shape option:selected').val();
  if (select == 'square' || select == 'circle' || select == 'diamond' || select == 'rombus') {
    $('#widthVal').val(width);
    $('.square').css('width', width + 'px');
    $('.circle').css('width', width + 'px');
    $('.diamond').css('width', width + 'px');
    $('.rombus').css('width', width + 'px');
  } else {
    $('#widthVal').val(width);
    $('.triangle').css('border-width', '0 ' + width + 'px ' + height + 'px ' + width + 'px');
  }

});

$('#widthVal').keyup(function () { //INPUT BOX SLIDER VAL
  var width = $(this).val();
  var height = ($('#height').val());
  var select = $('#shape option:selected').val();
  if (select == 'square' || select == 'circle' || select == 'diamond' || select == 'rombus') {
    $('#widthVal').val(width);
    $('.square').css('width', width + 'px');
    $('.circle').css('width', width + 'px');
    $('.diamond').css('width', width + 'px');
    $('.rombus').css('width', width + 'px');
  } else {
    $('#widthVal').val(width);
    $('.triangle').css('border-width', '0 ' + width + 'px ' + height + 'px ' + width + 'px');
  }
});

$('#heightVal').keyup(function () { //INPUT BOX SLIDER VAL
  var height = $(this).val();
  var width = ($('#width').val());
  var select = $('#shape option:selected').val();
  $('#height').val(height);
  if (select == 'square' || select == 'circle' || select == 'diamond' || select == 'rombus') {
    $('.square').css('height', height + 'px');
    $('.circle').css('height', height + 'px');
    $('.diamond').css('height', height + 'px');
    $('.rombus').css('height', height + 'px');
  } else {
    $('.triangle').css('border-width', '0 ' + width + 'px ' + height + 'px ' + width + 'px');
  }
});

$('#height').on('input', function () { //HEIGHT OF OBJECT (SQUARE)
  var height = $(this).val();
  var width = ($('#width').val());
  var select = $('#shape option:selected').val();
  $('#heightVal').val(height);
  if (select == 'square' || select == 'circle' || select == 'diamond' || select == 'rombus') {
    $('.square').css('height', height + 'px');
    $('.circle').css('height', height + 'px');
    $('.diamond').css('height', height + 'px');
    $('.rombus').css('height', height + 'px');
  } else {
    $('.triangle').css('border-width', '0 ' + width + 'px ' + height + 'px ' + width + 'px');
  }
});

// CONVERTING ELEMENTS INTO PHP _POST METHOD IDENTIFIABLE VARIBLES ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

$('#submit').click(function () {
  data = $('#title').val();
  code = $('#code').text();
  favDur = $('#right-code').text();
  $('#useDataField').val(data);
  $('#useDataFieldTwo').val(code);
  $('#useDataFieldThree').val(favDur);
  $('#favForm').submit();
});

// LOGIN ANIMATIONS
$(".log-in").click(function () {
  $(".signIn").addClass("active-dx");
  $(".signUp").addClass("inactive-sx");
  $(".signUp").removeClass("active-sx");
  $(".signIn").removeClass("inactive-dx");
});

$(".back").click(function () {
  $(".signUp").addClass("active-sx");
  $(".signIn").addClass("inactive-dx");
  $(".signIn").removeClass("active-dx");
  $(".signUp").removeClass("inactive-sx");
});

// DOWNLOAD FUNCTION ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

function downloadInnerHtml(filename, elId, mimeType) {
  var elHtml = document.getElementById(elId).innerHTML;
  var link = document.createElement('a');
  mimeType = mimeType || 'text/plain';

  link.setAttribute('download', filename);
  link.setAttribute('href', 'data:' + mimeType + ';charset=utf-8,' + encodeURIComponent(elHtml));
  link.click();
}

var fileName = 'ani-mate.css'; // You can use the .txt extension if you want

$('#downloadLink').click(function () {
  downloadInnerHtml(fileName, 'code', 'text/html');
});

// SAVE FUNCTION ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

$('.save').click(function () {
  if (parseInt($(window).width()) <= 1280) {
    $('.save-box').slideDown(300);
    $('.textarea').css('margin-top', '0px');
    $('.textarea textarea').css('height', '300px');
  } else {
    $('.save-box').slideDown(300);
    $('.textarea').css('margin-top', '0px');
    $('.textarea textarea').css('height', '360px');
  }
});
