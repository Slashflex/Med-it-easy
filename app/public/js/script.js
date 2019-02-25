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
    /* Back to top button */
    let btn = $("#buttonToTop");
    btn.on("click", function (e) {
        e.preventDefault();
        $("html, body").animate({
                scrollTop: 0
            },
            "300"
        );
    });
    /*========== End of Back to top button script  ===========*/

    /*==========================================================
    ========  Section Scroll on Section (from navLinks)  =======
    ==========================================================*/
    // $(function () {
    $("#scrollToConcept").click(function () {
        $("html, body").animate({
                scrollTop: $(".concept_height").offset().top
            },
            900
        );
    });
    $("#scrollToSolution").click(function () {
        $("html, body").animate({
                scrollTop: $(".solution_height").offset().top
            },
            900
        );
    });
    $("#scollToPricing").click(function () {
        $("html, body").animate({
                scrollTop: $(".pricing_height").offset().top
            },
            900
        );
    });
    // Allows the return to sections of the home.php view ...
    //... from other pages (like registerPatient, connexionPatient etc ...)
    $("index.php#test").click(function () {
        $("html, body").animate({
                scrollTop: $("#test1").offset().top
            },
            900
        );
    });
    $("index.php#scrollToSolution").click(function () {
        $("html, body").animate({
                scrollTop: $("#test2").offset().top
            },
            900
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
    /* Change background on hover */
    $(".icon_color").on("mouseenter", function () {
        $(this).css("background-color", "#dbae58");
    });
    /* Reset background to default one */
    $(".icon_color").on("mouseleave", function () {
        $(this).css("background-color", "#353c3f");
    });

    /*=====  End of script to swap social network icons  =====*/

    /*==========================================================
    ===========       Section Word Swap            =============
    ==========================================================*/
    function wordSwap() {
        $("#word_swap").delay(2000)
            .animate({
                opacity: 0
            }, function () {
                $(this).text("innovant").animate({
                    opacity: 1
                }, function () {
                    $(this).delay(2000).animate({
                        opacity: 0
                    }, function () {
                        $(this).text("rapide").animate({
                            opacity: 1
                        }, function () {
                            $(this).delay(2000).animate({
                                opacity: 0
                            }, function () {
                                $(this).text("économique").animate({
                                    opacity: 1
                                }, function () {
                                    wordSwap();
                                });
                            });
                        });
                    });
                });
            });
    }
    wordSwap();
    /*===============  End of Section Word Swap  =================*/
    

    /*==========================================================
    ===========  Section Reg EXp control on forms   ============
    ==========================================================*/
    $('#first').keyup(function () {
        if (!$('#first').val().match(/^[A-Za-zéèêîïôüäë -]+$/i)) {
            $('#first').next('.error-message').show().text('Veuillez entrez un prénom valide');
        } else {
            $('#first').next('.error-message').hide().text('');
        }
    });
    $('#last').keyup(function () {
        if (!$('#last').val().match(/^[A-Za-zéèêîïôüäë -]+$/i)) {
            $('#last').next('.error-message').show().text('Veuillez entrez un nom valide');
        } else {
            $('#last').next('.error-message').hide().text('');
        }
    });
    // $('#birthDate').keyup(function () {
    //     if (!$('#birthDate').val().match(/^[0-9/]+$/)) {
    //         $('#birthDate').next('.error-message').show().text('Veuillez entrez une date valide');
    //     } else {
    //         $('#birthDate').next('.error-message').hide().text('');
    //     }
    // });
    $('#mail').keyup(function () { // 
        if (!$('#mail').val().match(/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/)) {
            $('#mail').next('.error-message').show().text('Veuillez entrez une adresse mail valide');
        } else {
            $('#mail').next('.error-message').hide().text('');
        }
    //});
    $('#mailLogin').keyup(function () { // 
        if (!$('#mailLogin').val().match(/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/)) {
            $('#mailLogin').next('.error-message').show().text('Veuillez entrez une adresse mail valide');
        } else {
            $('#mailLogin').next('.error-message').hide().text('');
        }
        // });
        // $('#password_1').keyup(function () {
        //     if (!$('#password_1').val().match(/^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-+(?:\.]{8,20}*$/)) {
        //         $('#password_1').next('.error-message').show().text('Veuillez entrez un mot de passe valide');
        //     } else {
        //         $('#password_1').next('.error-message').hide().text('');
        //     }
        //});
        // $('#password_2').keyup(function () {
        //     if (!$('#password_2').val().match(/^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-+(?:\.]*$/)) {
        //         $('#password_2').next('.error-message').show().text('Veuillez entrez un mot de passe valide');
        //     } else {
        //         $('#password_2').next('.error-message').hide().text('');
        //     }
        // });

        // $("#send").click(function () {
        //     valid = true;
        //     if ($('#first').val() == '') {
        //         $('#first').next('.error-message').fadeIn().text('Veuillez entrez votre prénom');
        //         valid = false;
        //     } else if (!$('#first').val().match(/^[a-zA-Z-]+$/i)) {
        //         $('#first').next('.error-message').fadeIn().text('Veuillez entrez un prénom valide');
        //     } else {
        //         $('#first').next('.error-message').fadeOut()
        //     }
        //     if ($('#last').val() == '') {
        //         $('#last').next('.error-message').fadeIn().text('Veuillez entrez votre nom');
        //         valid = false;
        //     } else {
        //         $('#last').next('.error-message').fadeOut()
        //     }
        //     if ($('#birthDate').val() == '') {
        //         $('#birthDate').next('.error-message').fadeIn().text('Veuillez entrez votre date de naissance');
        //         valid = false;
        //     } else {
        //         $('#birthDate').next('.error-message').fadeOut()
        //     }
        //     if ($('#mail').val() == '') {
        //         $('#mail').next('.error-message').fadeIn().text('Veuillez entrez une adresse e-mail');
        //         valid = false;
        //     } else {
        //         $('#mail').next('.error-message').fadeOut()
        //     }
        //     if ($('#password_1').val() == '') {
        //         $('#password_1').next('.error-message').fadeIn().text('Veuillez entrez votre mot de passe');
        //         valid = false;
        //     } else {
        //         $('#password_1').next('.error-message').fadeOut()
        //     }
        //     if ($('#password_2').val() == '') {
        //         $('#password_2').next('.error-message').fadeIn().text('Veuillez confirmer votre mot de passe');
        //         valid = false;
        //     } else {
        //         $('#password_2').next('.error-message').fadeOut()
        //     }
        //     return false;
/*=======  End of Section Reg EXp control on forms  =========*/



    

        // $(document).ready(function () {
        //     $('[data-toggle="tooltip"]').tooltip();
         });
        
    });
});
$(function(){
    $('.nav a').filter(function(){return this.href==location.href}).parent().addClass('active').siblings().removeClass('active')
    $('.nav a').click(function(){
        $(this).parent().addClass('active').siblings().removeClass('active')	
    })
})

/*========  End of Section Reg EXp control on forms  ========*/







/*=============================================================
==========================  TESTS   ===========================
=============================================================*/


/*======================  End of TESTS  =====================*/