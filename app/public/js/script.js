/*===========================================================
========          Back to top button script          ========
===========================================================*/
$(function () {
    $(window).scroll(function () {
        if ($(window).scrollTop() > 200) {
            btn.addClass("show");
        } else {
            btn.removeClass("show");
        }
    });
    // Back to top button
    let btn = $("#buttonToTop");
    btn.on("click", function (e) {
        e.preventDefault();
        $("html, body").animate({
                scrollTop: 0
            },
            "900"
        );
    });
    /*========== End of Back to top button script  ===========*/

    /*==========================================================
    ========  Section Scroll on Section (from navLinks)  =======
    ==========================================================*/
    $("#scrollToConcept").click(function () {
        $("html, body").animate({
                scrollTop: $(".concept_height").offset().top
            },
            2000
        );
    });
    $("#scrollToSolution").click(function () {
        $("html, body").animate({
                scrollTop: $(".solution_height").offset().top
            },
            2000
        );
    });
    $("#scollToPricing").click(function () {
        $("html, body").animate({
                scrollTop: $(".pricing_height").offset().top
            },
            2000
        );
    });
    // Allows the return to sections of the home.php view ...
    //... from other views (like registerPatient, connexionPatient etc ...)
    $("index.php#test").click(function () {
        $("html, body").animate({
                scrollTop: $("#test1").offset().top
            },
            2000
        );
    });
    $("index.php#scrollToSolution").click(function () {
        $("html, body").animate({
                scrollTop: $("#test2").offset().top
            },
            2000
        );
    });
    $("index.php#scollToPricing").click(function () {
        $("html, body").animate({
                scrollTop: $("#test3").offset().top
            },
            900
        );
    });

    /*============ End of Section Scroll on section  ==========*/

    /*===========================================================
    ============ Script to swap social network icons  ===========
    ===========================================================*/
    let sourceSwap = function () {
        let $this = $(this);
        let newSource = $this.data("alt-src");
        $this.data("alt-src", $this.attr("src"));
        $this.attr("src", newSource);
    };
    $("img.icon_color").hover(sourceSwap, sourceSwap);
    // Change background on hover
    $(".icon_color").on("mouseenter", function () {
        $(this).css("background-color", "#dbae58");
    });
    // Reset background to default one
    $(".icon_color").on("mouseleave", function () {
        $(this).css("background-color", "#353c3f");
    });

    /*=====  End of script to swap social network icons  =====*/

    /*==========================================================
    ===========  Section Reg EXp control on forms   ============
    ==========================================================*/
    $('#first').keyup(function () { // First name reg exp check
        if (!$('#first').val().match(/^[a-zA-Zéèêîïôüùâàäë]+([\ \-]{0,1})[a-zA-Zéèêîïôüùâàäë]*$/i)) {
            $('#first').next('.error-message').show().text('Veuillez entrer un prénom valide');
        } else {
            $('#first').next('.error-message').hide().text('');
        }
    });
    $('#last').keyup(function () { // Last name reg exp check
        if (!$('#last').val().match(/^[a-zA-Zéèêîïôüùâàäë]+([\ \-]{0,1})[a-zA-Zéèêîïôüùâàäë]*$/i)) {
            $('#last').next('.error-message').show().text('Veuillez entrer un nom valide');
        } else {
            $('#last').next('.error-message').hide().text('');
        }
    });
    $('#mail').keyup(function () { // Email reg exp check
        if (!$('#mail').val().match(/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+.[a-z]{2,4}$/)) {
            $('#mail').next('.error-message').show().text('Veuillez entrer une adresse mail valide');
        } else {
            $('#mail').next('.error-message').hide().text('');
        }
    });
    $('#password_1').keyup(function () { // Password reg exp check
        if (!$('#password_1').val().match(/^[A-Z][a-zA-Z0-9_-]{7,20}$/)) {
            $('#password_1').next('.error-message').show().text('Votre mot de passe doit commencer par une majuscule et comporter au moins 8 caractères (e.g : Azerty_-1234)');
        } else {
            $('#password_1').next('.error-message').hide().text('');
        }
    });
    $('#password_2').keyup(function () { // Password confirm reg exp check
        if (!$('#password_2').val().match(/^[A-Z][a-zA-Z0-9_-]{7,20}$/)) {
            $('#password_2').next('.error-message').show().text('Vos deux mots de passe ne correspondent pas');
        } else {
            $('#password_2').next('.error-message').hide().text('');
        }
    });
    // --- PASSWORDS INPUTS CHECK (if OK, add box-shadow green around fields, else add a red one)
    $(function () {
        $('#password_2').blur(function () {
            let pass = $('input[name=password_1]').val();
            let repass = $('input[name=password_2]').val();
            if (($('input[name=password_1]').val().length == 0) || ($('input[name=password_2]').val().length == 0)) {
                $('#password_1').addClass('regExpFalse');
            } else if (pass != repass) {
                $('#password_1').addClass('regExpFalse');
                $('#password_2').addClass('regExpFalse');
            } else {
                $('#password_1').removeClass().addClass('regExpOk');
                $('#password_2').removeClass().addClass('regExpOk');
            }
        });
    });
    /*=======  End of Section Reg EXp control on forms  =========*/
});
// --- INFORMATION PANEL ON REGEXEP TO BE USED (register forms)
$(function () {
    $('.bgInfos').mouseenter(function () {
        $('.toggleInfos').toggle('slow');
    });
});
// --- ADD ACTIVE CLASS ON NAV LINK WHEN CLiCKED
$(function () {
    $('.nav a:lt(3)').filter(function () {
        return this.href == location.href
    }).parent().addClass('active').siblings().removeClass('active')
    $('.nav a:lt(3)').click(function () {
        $(this).parent().addClass('active').siblings().removeClass('active')
    });
});

// --- HAMBURGER NAVIGATION BUTTON (appears on medium screen viewport)
$(function () {
    $('.first-button').on('click', function () {
        $('.burgerNav').toggleClass('open');
    });
});
// --- EDIT BUTTON (app\views\patients\listRdv.php)
$(function () {
    $('.editBtn').mouseenter(function () {
        $('.fa-edit').css('color', '#353c3f');
    });
    $('.editBtn').mouseleave(function () {
        $('.fa-edit').css('color', '#dbae58');
    });
});







/*=============================================================
==========================  TESTS   ===========================
=============================================================*/
$(function() {
    $('a[href*=#]').on('click', function(e) {
      e.preventDefault();
      $('html, body').animate({ scrollTop: $($(this).attr('href')).offset().top}, 2000, 'linear');
    });
  });
/*======================  End of TESTS  =====================*/