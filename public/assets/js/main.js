$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $("#register").click(proveriRegister);
    $("#login").click(proveriLogin);
    if(routeName == 'posts.show'){
        if(userId){
            if(window.localStorage.getItem('hasClass') == 'true'){
                $("#" + window.localStorage.getItem('id') + " button").toggleClass("votedBorder");
            }
            else if (window.localStorage.getItem('hasClass') == 'false'){
                $("#" + window.localStorage.getItem('id') + " button").removeClass("votedBorder");
            }
        }
        $("#commentSubmit").click(proveriKomentar);
        ispisiKomentare();
        $("#postLike button").click(oceniPost);
        $("#postDislike button").click(oceniPost);
    }
    if(routeName == 'contact'){
        $("#submitMessage").click(proveriMessage);
    }
    if(routeName == 'users.edit'){
        var ime =$('#imeEdit').val();
        var prezime =$('#prezimeEdit').val();
        var email =$('#emailEdit').val();
        var username = $('#usernameEdit').val()
        var passOld = $('#passOld').val()
        var passNew = $('#passNew').val()
        $("#submitUserEdit").click(function(event){proveriUserEdit(ime, prezime, email, username, passOld, passNew)});
    }
    $("#summernote").summernote();
});
function proveraTb(polje, regExp, text){
    if(!regExp.test(polje.val())){
        polje.addClass("greska");
        polje.next().html(text);
        return false;
    }
    else {
        polje.removeClass("greska");
        polje.next().html("");
        return true;
    }
}
function proveriRegister(e){
    e.preventDefault();
    $("#errorReg").hide();
    $("#successReg").hide();

    let regExpName =/^([A-ZĐŠĆŽČ][a-zšđćžč]{1,14})+(\s[A-ZĐŠĆŽČ][a-zšđćžč]{2,14})*$/;
    let regExpEmail = /^([a-z0-9]{2,15}@[a-z]{2,10}\.[a-z]{2,5})(\.[a-z]{2,5})*$/;
    let regExpUsername = /[\dA-z\.\-\_]{4,15}/;

    let imeIspravno, prezimeIspravno, mailIspravno, passIspravno, userIspravno;

    imeIspravno = proveraTb($('#ime'), regExpName, "Unesite ime u željenom formatu: Petar (2-15 karaktera) ")
    prezimeIspravno = proveraTb($('#prezime'), regExpName, "Unesite prezime u željenom formatu: Mišković Perić ");
    mailIspravno = proveraTb($('#email'), regExpEmail, "Unesite email u željenom formatu (petar@gmail.com)");
    passIspravno = proveraTb($('#pass'), regExpUsername, "Dozvoljeni brojevi, slova i .-_ (4-15 karaktera)");
    userIspravno = proveraTb($('#username'), regExpUsername, "Dozvoljeni brojevi, slova i .-_ (4-15 karaktera)");

    if(imeIspravno && prezimeIspravno && mailIspravno && passIspravno && userIspravno){
        $.ajax({
            type: "POST",
            url: "register",
            data: {
                ime: $('#ime').val(),
                prezime: $('#prezime').val(),
                email: $('#email').val(),
                pass: $('#pass').val(),
                username: $('#username').val()
            },
            dataType:"json",
            success: function (data) {

                vratiPocetnoStanje([ $('#ime'), $('#prezime'), $('#email'), $('#pass'), $('#username')]);
                if(data.message == "success"){
                    $("#successReg").hide();
                    $("#errorReg").hide();
                    $("#successReg").fadeIn();
                }
            },
            error: function(error){
                vratiPocetnoStanje([ $('#ime'), $('#prezime'), $('#email'), $('#pass'), $('#username')]);
                if(error.status == 422){
                    $("#errorReg").hide();
                    $("#successReg").hide();
                    for(el in error.responseJSON.errors){
                        $('#' + el).next().html(error.responseJSON.errors[el][0]);
                    }
                }
                if(error.status >= 400 && error.status != 422){
                    $("#errorReg").hide();
                    $("#successReg").hide();
                    $("#errorReg").fadeIn();
                }

            }
        });
    }
}
function proveriLogin(e){
    e.preventDefault();
    $("#errorLog").hide();
    let regExpUsername = /[\dA-z\.\-\_]{4,15}/;
    let passIspravno = proveraTb($('#usernameLog'), regExpUsername, "Dozvoljeni brojevi, slova i .-_ (4-15 karaktera)");
    let userIspravno = proveraTb($('#passLog'), regExpUsername, "Dozvoljeni brojevi, slova i .-_ (4-15 karaktera)");

    if(passIspravno && userIspravno){
        $.ajax({
            type:'POST',
            url:'login',
            data:{
                usernameLog:$('#usernameLog').val(),
                passLog:$('#passLog').val(),
            },
            success: function (data){
                window.location.replace(data);
            },
            error: function (error){
                vratiPocetnoStanje([$('#usernameLog'), $('#passLog')]);
                if(error.status == 422){
                    for(el in error.responseJSON.errors){
                        $('#' + el).next().html(error.responseJSON.errors[el]);
                    }
                }
                else{
                    $("#errorLog").hide();
                    $("#errorLog").fadeIn();
                }
            }
        })
    }
}
function ispisiKomentare(){
    var postId = $("#postId").val();

    $.ajax({
        type:'GET',
        url:`${postId}/comments`,
        success: function (data){
            ispisKomentar(data);
            $(".commentRating").click(oceniKomentar);
            $(".commentDelete").click(izbrisiKomentar);
        },
        error: function (error){
        }
    });
}
function ispisKomentar(data){
    console.log(data)
    data = JSON.parse(data);
    var ispis = ``;
    data.forEach(el=>{
        let positiveRating = 0;
        let negativeRating = 0;
        var ratingIndex;
        for(let rating of el.ratings){
            if(rating.rating_index == 1) positiveRating++;
            if(rating.rating_index == 0) negativeRating++;
            if(rating.user_id == userId){
                ratingIndex = rating.rating_index;
            }
        }
        let date = new Date(el.created_at)
        ispis+=`
                        <div class="container border-top py-2 d-flex align-items-center mt-3">
                    <div class="col-2 col-sm-1">
                        <img class="commentImage zaobljeno" src="${assets}assets/img/users/${el.user.user_image.image.path}" alt="${el.user.user_image.image.alt}">
                    </div>
                    <div class="col-10 col-sm-11">
                        <div class="row d-flex ps-3 pe-2 pe-sm-5 mt-1 align-items-center">
                            <p class="fw-bold float-left w-25">${el.user.username}</p><p class="w-75 text-end">${date.getDate()}-${date.getMonth()+1}-${date.getFullYear()}`
                            if( admin || userId == el.user.id) ispis += ` <span class="ms-sm-2 me-2"><a href="#" data-id="${el.id}" class="btn commentDelete"><i class="fas fa-trash text-white"></i></a></span>`;
                        ispis +=`</p>
                        </div>
                        <div class="container d-flex justify-content-around align-items-center">
                            <div class="col-9 px-1 d-flex flex-column justify-content-center">
                                <p>${el.text}</p>
                            </div>
                            <div class="col-3 d-flex flex-column align-items-center">
                                <div class="col-12 col-sm-6 mb-2 d-flex flex-column align-items-center flex-sm-row justify-content-center">
                                    <button data-rating-index="1" data-comment-id="${el.id}" class="btn  commentLike commentRating`;
                                        if(ratingIndex == 1) ispis += ` votedBorder`;
                                        ispis += '"';
                                        if(!loggedIn) ispis += ` disabled="disabled"`;
                                        ispis += `>
                                        <i class="fas fa-chevron-up zelena"></i>
                                    </button>
                                    <span class="ps-sm-2">${positiveRating}</span>
                                </div>
                                <div class="col-12 col-sm-6 d-flex flex-column align-items-center flex-sm-row justify-content-center">
                                    <button data-rating-index="0" data-comment-id="${el.id}" class="btn commentDislike commentRating`;
                                        if(ratingIndex == 0) ispis += ` votedBorder`;
                                        ispis += '"';
                                        if(!loggedIn) ispis +=  ` disabled="disabled"`;
                                        ispis += `>
                                        <i class="fas fa-chevron-down text-danger"></i>
                                    </button>
                                    <span class="ps-sm-2">${negativeRating}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        `;
            $("#comment-section").html(ispis);
    })
}
function oceniPost(){
    var postId = $("#postId").val();
    var obj = $(this);
    var ratingIndex = obj.data('ratingIndex');

    $.ajax({
        url: postId + "/post-ratings",
        method: 'POST',
        data: {
            postId:postId,
            ratingIndex:ratingIndex,
            userId:userId
        },
        success: function(data){
            if(data.redirect){
                let id = obj.parent().attr('id')

                obj.toggleClass('votedBorder');
                let hasClass = obj.hasClass('votedBorder');
                window.localStorage.setItem('id', id);
                window.localStorage.setItem('hasClass', hasClass);
                if(data.disenchant){
                    window.localStorage.setItem('hasClass', "false");
                }
                window.location.reload();

            }
        },
        error: function (error){
            console.log(error)
            if(error.status == 401){
                window.location.href = assets + 'login';
            }
        }
    });
}
function oceniKomentar(){
    let obj = $(this);
    console.log("pocela je ocena")
    var postId = $("#postId").val();
    var ratingIndex = $(this).data('rating-index');
    var commentId = $(this).data('comment-id');

    $.ajax({
        type:'POST',
        url:`${postId}/comments/${commentId}/comment-ratings`,
        data:{
            ratingIndex:ratingIndex,
            userId:userId
        },
        success: function (data){
            ispisiKomentare();
            obj.addClass("votedBorder");
        },
        error: function (error){
        }
    })
}
function proveriKomentar(e){
    e.preventDefault();
    $("#errorCom").hide();
    $("#successCom").hide();
    var postId = $("#postId").val();
    console.log("usli smo u funkciju");
    console.log($("#commentInput").val().length);
    if( $("#commentInput").val().length == 0 || $("#commentInput").val().length > 250 ){
        $("#commentInput").css('border', '1px solid red');
        $("#commentInput").next().children().html("Vaš komentar ne sme biti prazan, niti duži od 250 karaktera");
        $("#successCom").hide();
    }
    else{
        $("#commentInput").next().children().html("");
        $("#commentInput").css('border', '1px solid #ced4da');

        $.ajax({
            type:'POST',
            url:`${postId}/comments`,
            data:{
                userId:userId,
                text:$("#commentInput").val()
            },
            success: function (data){
                vratiPocetnoStanje([$("#commentInput")]);
                $("#commentInput").val("");
                $("#errorCom").hide();
                $("#successCom").hide();
                $("#successCom").fadeIn();
                ispisiKomentare();

            },
            error: function (error){

                if(error.status == 422){
                    $("#errorCom").hide();
                    $("#successCom").hide();
                    $("#commentInput").css('border', '1px solid red');
                    $("#commentInput").next().children().html(error.responseJSON.errors.text[0]);

                }
                else{
                    $("#errorCom").hide();
                    $("#successCom").hide();
                    $("#errorCom").fadeIn();
                }
            }
        })

    }
}
function izbrisiKomentar(e){
    var postId = $("#postId").val();
    e.preventDefault();
    console.log("komentar pozvan za  brisanje");
    var commentId = $(this).data('id');dd
    $.ajax({
        type:'DELETE',
        url:`${postId}/comments/${commentId}`,
        success: function (data){
            window.location.reload();
        },
        error: function (error){
        }
    })
}
function proveriMessage(e){
    e.preventDefault();
    $("#errorSubmit").hide();
    $("#successSubmit").hide();
    $("#errorSubmit").hide();
    $("#successSubmit").hide();

    let imeIspravno, subjIspravno, emailIspravno, messageIspravno;

    let regExpEmail = /^([a-z0-9]{2,15}@[a-z]{2,10}\.[a-z]{2,5})(\.[a-z]{2,5})*$/;
    let regExpIme = /^[A-zČĆŽĐŠćčžđš]{2,20}(\s[A-zČĆŽĐŠćčžđš]{2,20})*$/;
    let regExpSub = /^[A-zČĆŽĐŠćčžđš][A-zČĆŽĐŠćčžđš\d]{2,20}(\s[A-zČĆŽĐŠćčžđš\d]{1,20})*$/

    imeIspravno = proveraTb($("#nameContact"), regExpIme, "Dozvoljena samo slova (maksimalna dužina 20)");
    emailIspravno = proveraTb($('#emailContact'), regExpEmail, "Unesite email u željenom formatu (petar@gmail.com)");
    subjIspravno = proveraTb($('#subject'), regExpSub, "Naslov mora počinjati slovom i nisu dozvoljeni specijalni karakteri (maksimalna dužina 70 karaktera )");

    if($("#message").val().trim().length == 0 || $("#message").val().trim().length > 250){
        $("#message").next().html("Poruka ne sme biti prazna niti da prelazi 250 karaktera");
        $("#message").css('border', '1px solid red');
        messageIspravno = false;
    }
    else{
        $("#message").next().html("");
        $("#message").css('border', '1px solid #ced4da');
        messageIspravno = true;
    }

    if( imeIspravno && emailIspravno && subjIspravno && messageIspravno ){
        $.ajax({
            type:'POST',
            url:`contact`,
            data:{
                nameContact:$("#nameContact").val(),
                emailContact:$("#emailContact").val(),
                subject:$("#subject").val(),
                message:$("#message").val()
            },
            success: function (data){
                vratiPocetnoStanje([$("input"),  $("textarea")]);
                $("#successSubmit").hide();
                $("#successSubmit").fadeIn();
            },
            error: function (error){
                vratiPocetnoStanje([$("input"),  $("textarea")]);
                if(error.status == 422){
                    $("#errorSubmit").hide();
                    $("#successSubmit").hide();
                    for(el in error.responseJSON.errors){
                        $('#' + el).next().html(error.responseJSON.errors[el][0]);
                    }
                }
                else{
                    $("#errorSubmit").hide();
                    $("#successSubmit").hide();
                    $("#errorSubmit").fadeIn();
                }
            }
        })
    }
}
function proveriUserEdit(ime, prezime, email, username, passOld, passNew){
    event.preventDefault();
    $("#errorUserEdit").hide();
    $("#successUserEdit").hide();

    let imeIspravno, prezimeIspravno, mailIspravno, passNewIspravno, userIspravno, passOldIspravno;

    passOldIspravno = true;
    passNewIspravno = true;
    let slika = $('#profilePictureFile').prop('files')[0] ? $('#profilePictureFile').prop('files')[0] : null

    let regExpName =/^([A-ZĐŠĆŽČ][a-zšđćžč]{1,14})+(\s[A-ZĐŠĆŽČ][a-zšđćžč]{2,14})*$/;
    let regExpEmail = /^([a-z0-9]{2,15}@[a-z]{2,10}\.[a-z]{2,5})(\.[a-z]{2,5})*$/;
    let regExpUsername = /[\dA-z\.\-\_]{4,15}/;

    imeIspravno = proveraTb($('#imeEdit'), regExpName, "Unesite ime u željenom formatu: Petar (2-15 karaktera) ")
    prezimeIspravno = proveraTb($('#prezimeEdit'), regExpName, "Unesite prezime u željenom formatu: Mišković Perić ");
    mailIspravno = proveraTb($('#emailEdit'), regExpEmail, "Unesite email u željenom formatu (petar@gmail.com)");
    userIspravno = proveraTb($('#usernameEdit'), regExpUsername, "Dozvoljeni brojevi, slova i .-_ (4-15 karaktera)");

    if(passOld != $('#passOld').val()){
        passNewIspravno = proveraTb($('#passNew'), regExpUsername, "Dozvoljeni brojevi, slova i .-_ (4-15 karaktera)");
        passOldIspravno = proveraTb($('#passOld'), regExpUsername, "Dozvoljeni brojevi, slova i .-_ (4-15 karaktera)");
    }

    if(ime==$('#imeEdit').val() && prezime == $('#prezimeEdit').val() && email == $('#emailEdit').val() && username == $('#usernameEdit').val() && passOld == $('#passOld').val() && passNew == $('#passNew').val() && !($(profilePictureFile).prop('files')[0]) ){
        $("#errorUserEdit").hide();
        $("#successUserEdit").hide();
        $("#errorUserEdit").html('Podaci su identični kao pre, molimo Vas izvršite neku izmenu.');
        $("#errorUserEdit").fadeIn();
    }
    else if(imeIspravno && prezimeIspravno && mailIspravno && userIspravno && passOldIspravno && passNewIspravno){
        var userId = $("#userId").val();
        var form = new FormData();
        if($(profilePictureFile).prop('files')[0]) form.set('profilePictureFile', $(profilePictureFile).prop('files')[0]);
        form.set('imeEdit', $('#imeEdit').val());
        form.set('prezimeEdit', $('#prezimeEdit').val());
        form.set('emailEdit', $('#emailEdit').val());
        form.set('usernameEdit', $('#usernameEdit').val());
        form.set('passOld', $('#passOld').val() ? $('#passOld').val() : null);
        form.set('passNew', $('#passNew').val() ? $('#passNew').val() : null);
        form.set('_method', 'PUT');

        $.ajax({
            type: "POST",
            url: `${baseUrl}/users/${userId}`,
            data:form,
            dataType:"json",
            cache:false,
            processData: false,
            contentType: false,
            success: function (data) {
                vratiPocetnoStanje([$("input[type='password']")]);
                $("input[type='file']").next().html("");
                window.location.reload();

            },
            error: function(error){
                vratiPocetnoStanje([$("input[type='password']")]);
                $("input[type='file']").next().html("");
                if(error.status == 422){
                    $("#errorUserEdit").hide();
                    $("#successUserEdit").hide();
                    for(el in error.responseJSON.errors){
                        if(el != "profilePictureFile")$('#' + el).css('border', '1px solid red');
                        $('#' + el).next().html(error.responseJSON.errors[el][0]);
                    }
                }
                else if(error.status == 401){
                    $("#errorUserEdit").hide();
                    $("#successUserEdit").hide();
                    $("#errorUserEdit").html('Stara lozinka nije tačna!');
                    $("#errorUserEdit").fadeIn();
                }
                else{
                    $("#errorUserEdit").hide();
                    $("#successUserEdit").hide();
                    $("#errorUserEdit").html('Došlo je do greške prilikom izmene podataka, molim vas pokušajte kasnije.');
                    $("#errorUserEdit").fadeIn();
                }
            }
        })
    }
}
function vratiPocetnoStanje(ellements){
    $.each(ellements, function(index, value){
        value.next().html("");
        value.css('border', '1px solid #ced4da');
    })
}
