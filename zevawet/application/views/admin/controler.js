angular.module('starter.controllers', ['ionic', 'ngCordova', 'ionic-datepicker', 'utf8-base64'])
.config(function (ionicDatePickerProvider) {
    var datePickerObj = {
        inputDate: new Date(),
        titleLabel: 'Select a Date',
        setLabel: 'Set',
        todayLabel: 'Today',
        closeLabel: 'Close',
        mondayFirst: false,
        weeksList: ["S", "M", "T", "W", "T", "F", "S"],
        monthsList: ["Jan", "Feb", "March", "April", "May", "June", "July", "Aug", "Sept", "Oct", "Nov", "Dec"],
        templateType: 'popup',
        from: new Date(2012, 8, 1),
        to: new Date(2018, 8, 1),
        showTodayButton: true,
        dateFormat: 'dd MMMM yyyy',
        closeOnSelect: false,
        disableWeekdays: []
    };

    ionicDatePickerProvider.configDatePicker(datePickerObj);
})
.controller('AppCtrl', function ($scope, $state, $ionicModal, $timeout, $rootScope, loginService, $ionicHistory, $log, $ionicLoading, base64, $translate, $ionicPopup) {
    $rootScope.serviceBase = "https://buzzbee.mobi";
    //$rootScope.serviceBase = "http://192.168.0.95:1597";
    $rootScope.loginreview = "";
    // With the new view caching in Ionic, Controllers are only called
    // when they are recreated or on app start, instead of every page change.
    // To listen for when this page is active (for example, to refresh data),
    // listen for the $ionicView.enter event:
    //$scope.$on('$ionicView.enter', function(e) {
    //});
    //$rootScope.name
    $scope.authourlpass = base64.encode('LoyaltyInsight:LoyaltyInsight2016');

    $rootScope.name = '';


    $scope.typeOptions = [
  { name: 'English', value: '1' },
  { name: 'Danish', value: '2' },
    ];
    $scope.signin = "Sign in";
    $scope.registrations = "Sign up";
    $scope.dropdownlanguages = $scope.typeOptions[0].value;
   
    var langValueSession = window.localStorage.getItem("langKey1");
   // $scope.language = $scope.typeOptions[0].value;
    if (langValueSession == "" || langValueSession == undefined) {
        $scope.dropdownlanguages = $scope.typeOptions[0].value;
        loginService.language($scope.typeOptions[0].value);
        $scope.signin = "Sign in";
        $scope.registrations = "Sign up";
        $scope.profile = "Profile";
        $scope.edit_profile = "EDIT PROFILE";
        $scope.delete_account = "DELETE MY ACCOUNT";
        $rootScope.lang = "";
        $scope.language = "";
    } else if (langValueSession == 2) {
        $scope.dropdownlanguages = langValueSession;
        $scope.signin = "Log ind";
        $scope.registrations = "Tilmeld dig";
        $scope.profile = "Profil";
        $scope.edit_profile = "REDIGER PROFIL";
        $scope.delete_account = "Slet min konto";
        $rootScope.lang = langValueSession;
        $scope.language = langValueSession;
        loginService.language(langValueSession);
    } else if (langValueSession == 1) {
        $scope.dropdownlanguages = langValueSession;
        loginService.language(langValueSession);
        $scope.signin = "Sign in";
        $scope.registrations = "Sign up";
        $scope.profile = "Profile";
        $scope.edit_profile = "EDIT PROFILE";
        $scope.delete_account = "DELETE MY ACCOUNT";
        $rootScope.lang = langValueSession;
        $scope.language = langValueSession;
    }



    $scope.showSelectValue = function (langKey) {
        loginService.language(langKey);
        window.localStorage.setItem("langKey", langKey);
        $scope.language = window.localStorage.getItem("langKey");
        window.localStorage.setItem("langKey1", langKey);
       
         //   $state.go("app.home");
         $state.reload();

        if ($scope.language == 1) {
            $scope.signin = "Sign in";
            $scope.registrations = "Sign up";
            $scope.profile = "Profile";
            $scope.delete_account = "DELETE MY ACCOUNT";
            $scope.edit_profile = "EDIT PROFILE";
            $rootScope.lang = $scope.language;
        } else {
            $scope.signin = "Log ind";
            $scope.registrations = "Tilmeld dig";
            $scope.profile = "Profil";
            $scope.edit_profile = "REDIGER PROFIL";
            $scope.delete_account = "Slet min konto";
            $rootScope.lang = $scope.language;

        }
    }





    $rootScope.nameggg = loginService.isAuthenticated();
    if ($rootScope.nameggg.userid1 != '') {
        //$rootScope.name
        //  loginService.isAlreadylogin($rootScope.name);
        $state.go("app.home");
    }

    $scope.edit_delete = function () {
        var language = $scope.lang;
        if (language == 2) {
            $scope.edit = '<b>REDIGER PROFIL</b>';
            $scope.delete = '<b>Slet min konto</b>';
            $scope.warningconfirm = 'Advarsel!';
            $scope.temp = 'Du er ved at slette din konto, og den kan ikke fortrydes - er du sikker p&aring;, at du stadig vil slette din konto?';

        } else if (language == 1) {
            $scope.edit = '<b>EDIT PROFILE</b>';
            $scope.delete = '<b>DELETE MY ACCOUNT</b>';
            $scope.warningconfirm = 'Warning!';
            $scope.temp = 'You are about to delete your account and it can not be undone - are you sure you still want to delete your account?';
        } else {
            $scope.edit = '<b>EDIT PROFILE</b>';
            $scope.delete = '<b>DELETE MY ACCOUNT</b>';
            $scope.warningconfirm = 'Warning!';
            $scope.temp = 'You are about to delete your account and it can not be undone - are you sure you still want to delete your account?';
        }

        var myPopup = $ionicPopup.show({

            scope: $scope,
            cssClass: 'change_s',
            buttons: [
              {
                  text: $scope.edit,
                  onTap: function (e) {
                      $state.go('app.updateprofile');
                  }
              },
              {
                  text: $scope.delete,
                  onTap: function (e) {
                      var confirmPopup = $ionicPopup.confirm({
                          cssClass: 'delete_account',
                          title: $scope.warningconfirm,
                          template: $scope.temp
                      });

                      confirmPopup.then(function (res) {
                          if (res) {

                              loginService.deleteaccount().then(function (responcedata) {
                                  use = "";
                                  loginService.logout(use);
                                  $state.go('app.login');
                                  location.reload();
                              });
                          }
                      })
                  }
              }
            ]
        })
    }

    // Form data for the login modal
    $scope.loginData = {};

    // Create the login modal that we will use later
    $ionicModal.fromTemplateUrl('templates/login.html', {
        scope: $scope
    }).then(function (modal) {
        $scope.modal = modal;
    });

    // Triggered in the login modal to close it





    // Open the login modal
    $scope.allcompanyslist = function () {
        $state.go("app.home");
    }
    $scope.registration = function () {
        $state.go("app.registration");
    }
    user = {};

    $scope.logout = function () {

        if (window.localStorage.getItem("rem") == "1") {
            use = 1;
        } else if (window.localStorage.getItem("rem") == '') {
            use = '';
        }

        language = '';
        if (window.localStorage.getItem("langKey") == '') {
            language = 1;
        } else if (window.localStorage.getItem("langKey") == '1') {
            language = 1;
        } else if (window.localStorage.getItem("langKey") == '2') {
            language = 2;
        }

        $scope.user = loginService.logout(use, language);

        if ($scope.user.remember != 'true') {

            $rootScope.name = '';
            $rootScope.nameggg = loginService.isAuthenticated();
            $rootScope.lang = $scope.user.languages;

            if ($scope.user.languages == '') {
                window.localStorage.getItem("langKey", "");
            } else {
                window.localStorage.getItem("langKey", $scope.user.languages);
            }
            //for clearing the input login details after login.
            $timeout(function () {

                $ionicHistory.clearCache();
                $ionicHistory.clearHistory();
                $log.debug('clearing cache')
            }, 300)

        } else {
            $rootScope.name = '';
            $rootScope.nameggg = loginService.isAuthenticated();
            $rootScope.UserName = $scope.user.UserName;
            $rootScope.Pwd = $scope.user.Pwd;
            $rootScope.remember = $scope.user.remember;
            if ($scope.user.languages == '') {
                window.localStorage.setItem("langKey1", "");
            } else {
                window.localStorage.setItem("langKey1", $scope.user.languages);
            }


            $timeout(function () {

                $ionicHistory.clearCache();
                $ionicHistory.clearHistory();
                $log.debug('clearing cache')
            }, 10000)

        }
        $state.go("app.login");
        location.reload();
    };


    $scope.showdots = function () {
        $ionicLoading.show({
            template: '<p>Login...</p><ion-spinner icon="dots" class="spinner-dark"></ion-spinner>'
        });
    };
    $scope.showlines = function () {
        $ionicLoading.show({
            template: '<p>   Please Wait...</p><ion-spinner icon="lines" class="spinner-calm" ></ion-spinner>'
        });
    };
    $scope.hide = function () {
        $ionicLoading.hide();
    };
    // Perform the login action when the user submits the login form
    $scope.doLogin = function () {
        console.log('Doing login', $scope.loginData);

        $timeout(function () {
            $scope.closeLogin();
        }, 1000);
    };
})
.controller('loginCtrl', function ($ionicPopup, $scope, $cordovaOauth, $stateParams, $rootScope, $state, loginService, $window, HelperService, $http, $ionicLoading, $cordovaSQLite) {


       $scope.lang = $rootScope.lang;
    
        $scope.language = window.localStorage.getItem("langKey1");
        ChangeValues($scope.language)
    
    $rootScope.$watch('lang', function (value) {

        //alert(value);
        if (value != "" ) {
            ChangeValues(value)
        }

    });
    function ChangeValues(value) {

        if (value == "" || null || value == undefined) {
            $scope.userNamePh = "Username";
            $scope.passwordPh = "Password";
            $scope.rememberMe = "Remember me!";
            $scope.logIn = "LOGIN";
            $scope.lastYourPassword = "Forgot your password";
            $scope.lang = "";

        }

        if (value == 1 || null || value == undefined) {
            $scope.userNamePh = "Username";
            $scope.passwordPh = "Password";
            $scope.rememberMe = "Remember me!";
            $scope.logIn = "LOGIN";
            $scope.lastYourPassword = "Forgot your password";
            $scope.lang = value;

        } else if (value == 2 || null || value == undefined) {

            $scope.userNamePh = "Brugernavn";
            $scope.passwordPh = "Adgangskode";
            $scope.rememberMe = "Husk mig";
            $scope.logIn = "LOG IND";
            $scope.lastYourPassword = "Glemt din adgangskode";
            $scope.lang = value;
        }

    }

    var onFailureCallback = function () {
    };
    $scope.user = {};
    $scope.user.remember = true;

    if ($rootScope.nameggg.rem != '') {

        var str = $rootScope.nameggg.UserName;
        var password = $rootScope.nameggg.Pwd;
        $scope.user.UserName = str.replace(/^"(.*)"$/, '$1');
        $scope.lang = $rootScope.lang;

    } else {

        $scope.user.UserName = '';
        $scope.user.Pwd = '';
        $scope.user.remember = '';


    }

    //console.log(window.localStorage.getItem('langKey'));


    //$scope.user = {};
    $scope.formSubmit = function () {


        $scope.showdots($ionicLoading);
        loginService.login($scope.user).then(function (responcedata) {

            if (responcedata.data.data.userId != "") {

                responcedata.data.data.userKey = responcedata.data.data.userKey.replace(/^"(.*)"$/, '$1');
                loginService.isAlreadylogin(responcedata.data.data.userId, responcedata.data.data.userKey).then(function (result) {
                    //console.log(responcedata.data.data.rem);

                    $rootScope.name = result.data.data;
                    $rootScope.img = result.data.data.ProfileImage;

                    if ($rootScope.loginreview > 0) {

                        var obj = { companyprofileid: $rootScope.loginreview, catgorey: 0 };
                        $rootScope.loginreview = "";
                        $state.go('app.product', { object: JSON.stringify(obj) });
                        //$ionicLoading.hide();


                    } else if (responcedata.data.data.userId != "" && responcedata.data.data.userKey != "") {

                        // console.log(window.localStorage.getItem("rem"));

                        if (window.localStorage.getItem("rem") == 1) {
                            //debugger;
                            $state.go('app.home');
                        } else {
                            // debugger;
                            $state.go('app.home');
                        }
                    }
                });
            }

            $ionicLoading.hide();
        }, function (errmsg) {
            // debugger;
            //console.log(errmsg);
            HelperService.showFailurePopup(errmsg, onFailureCallback, $scope, errmsg);
            $ionicLoading.hide();
        })
    }


    $scope.LoginwithFacebook = function () {
        debugger;
        //console.log("2222013218024849");
        //398161427246297
        $cordovaOauth.facebook("2222013218024849", ["email"]).then(function (result) {
            debugger;
            console.log("Response Object -> " + JSON.stringify(result));
            alert("Auth Success..!!" + result);
        }, function (error) {
            alert("Auth Failed..!!" + error);
        });
    }


    $scope.google_login = function () {
        debugger;
        console.log("clicked");
        $cordovaOauth.google("296852033043-g4ralqieobkro94u2cae8bf4h0sc65mh.apps.googleusercontent.com", ["email"]).then(function (result) {
            alert("Auth Success..!!" + result);
        }, function (error) {
            alert("Auth Failed..!!" + error);
        });
    }

})
 .controller('homeCtrl', function ($scope, $state, $rootScope, $stateParams, loginService, $ionicLoading) {
   
     $scope.lang = $rootScope.lang;
    
    
     $scope.language = window.localStorage.getItem("langKey1");
     ChangeValues($scope.language)
 

     $rootScope.$watch('lang', function (value) {
       if (value != "") {
             ChangeValues(value)
          
             $scope.allcompanyslist(1);
            
        }

     });
     function ChangeValues(value) {

         if (value == "" || null || value == undefined) {
             $scope.search = "Search";
             $scope.Search_location = 'Search Location';
             $scope.Category = "Categories";
             $scope.SubCategory = "SubCategory";
             $scope.Reviews = "Reviews";
             $scope.trues = true;
             $scope.lang = "";
             $scope.placeholder = "Search for a Company";

         } else if (value == 1 || null || value == undefined) {
             $scope.search = "Search";
             $scope.Search_location = 'Search Location';
             $scope.Category = "Categories";
             $scope.SubCategory = "SubCategory";
             $scope.Reviews = "Reviews";
             $scope.trues = true;
             $scope.placeholder = "Search for a Company";
             $scope.lang = value;


         } else if (value == 2 || null || value == undefined) {

             $scope.Search_location = 'Beliggenhed';
             $scope.Category = "Kategorier";
             $scope.SubCategory = "SubCategory";
             $scope.Reviews = "Anmeldelser";
             $scope.trues = false;
             $scope.lang = value;
             $scope.placeholder = "S&oslash;g efter en virksomhed";
         }

     }

    
     $scope.numberOfItemsToDisplay = 0;
     $rootScope.loginreview = "";
     $scope.companyslist = [];
     $scope.IsHidden = true;
     $scope.countryslist = "";
     $scope.cardhide = true;
     $scope.allcotagereyslist = [];
     $scope.allsubcatcotagereys = [];
     $scope.companynames = [];
     $scope.showlines($ionicLoading);
     // $state.reload();

     $scope.allcompanyslist = function (pageno) {
         loginService.companylist(pageno).then(function (result) {
             //debugger;
             console.log(result);
             $scope.companyslist = result.data.dropdpwn;
             $scope.numberOfItemsToDisplay = 1;
             // $scope.numberOfItemsToDisplay = 1;
             //  if ($scope.companyslist.length > 1) {
             $scope.cardhide = false;
             // }
             $ionicLoading.hide();

         });
         loginService.allcotagereys().then(function (result) {
             // console.log(result);
             if (result.data.status = true) {
                 $scope.allcotagereyslist = result.data.data;
                 console.log(result);

                 $scope.allcatogerys = $scope.allcotagereyslist[0];
             }
         });
         // $scope.$broadcast('scroll.infiniteScrollComplete');
     }
     $scope.loaddetails = function () {

         $scope.userdetails = loginService.isAuthenticated();

         if ($scope.userdetails.userid1 != "") {
             $scope.userdetails.usernme1 = $scope.userdetails.usernme1.replace(/^"(.*)"$/, '$1');
             loginService.isAlreadylogin($scope.userdetails.userid1, $scope.userdetails.usernme1).then(function (result) {

                 $rootScope.name = result.data.data;
                 $rootScope.img = result.data.data.ProfileImage;
                 $rootScope.role = $scope.userdetails.role_id;
                 // debugger;
                 console.log(result);
             });
         }

     }


     $scope.allcompanyslist(1);
     $scope.changecatogery = function (item) {
         //  console.log(item.Value);

         //debugger;
         loginService.changecotagereys(item.Value).then(function (result) {

             console.log(result);
             if (item.Value == "0") {
                 $scope.numberOfItemsToDisplay = 1;
             } else {
                 $scope.numberOfItemsToDisplay = -2;
             }
             $scope.companyslist = result.data.dropdpwn;

             $scope.allsubcatcotagereys = result.data.subcat;
             $scope.suballcatogerys = result.data.subcat[0];

             if ($scope.allsubcatcotagereys.length <= 1) {
                 $scope.IsHidden = true;
             } else {
                 $scope.IsHidden = false;
             }
         });
     }
     $scope.changesubcatogery = function (cat, item) {

         if (item.Value == 0 || item.Value == "") {
             $scope.IsHidden = true;
             $scope.changecatogery(cat);
         } else {
             $scope.IsHidden = false;

             loginService.changesubcotagereys(item.Value).then(function (result) {
                 console.log(result);
                 $scope.companyslist = result.data.dropdpwn;

             });
         }
     }
     $scope.allcompaneys = function (country, compy) {
        // alert(compy);
         if (country != "" || compy != "") {
             
             loginService.allcompaneys(country, compy).then(function (result) {
                 $scope.companyslist = result.data.dropdpwn;

             });
         } else {
             $scope.numberOfItemsToDisplay = 1;
             $scope.allcompanyslist(1);
         }
     }

     $scope.country = [];

     $scope.changecountry = function (autodata) {
       
         $scope.IsHidden = true;
         if (autodata != "") {
             $scope.numberOfItemsToDisplay = -2;
             console.log(autodata);
             loginService.searchcountry(autodata).then(function (result) {
                 console.log(result);
                 $scope.country = result.data;
                 
             });
         } else {
             $scope.companey = "";
             $scope.numberOfItemsToDisplay = 1;
             $scope.allcompanyslist(1);
         }

     }

     $scope.changecompaney = function (country, autodata) {
      
         $scope.IsHidden = true;
         if (autodata != "" || country != "") {
            
            $scope.numberOfItemsToDisplay = -2;
             loginService.searchcompaney(autodata, country).then(function (result) {
                 $scope.companynames = result.data.data;
                // debugger;
             });
         } else if (country != "") {
          
             $scope.allcompaneys(country, autodata);
         } else {
             //  $scope.numberOfItemsToDisplay = 1;
             $scope.allcompanyslist(1);
         }
     }


     $scope.viewcompaney = function (companyid, catgid) {
         var obj = { companyprofileid: companyid, catgorey: catgid }
         $state.go('app.product', { object: JSON.stringify(obj) });

     };
     $scope.companysli = [];
     $scope.allcompanyslimits = function (pageno) {
         loginService.companylist(pageno).then(function (result) {
             $scope.companysli = result.data.dropdpwn;
             for (var i = 0; i < result.data.dropdpwn.length ; i++) {
                 $scope.companyslist.push(result.data.dropdpwn[i]);
             }
             $scope.cardhide = false;
             // }
             $ionicLoading.hide();

         });
     };

     $scope.loadMore = function () {
         if ($scope.numberOfItemsToDisplay > 0) {
             $scope.numberOfItemsToDisplay += 1;
             $scope.allcompanyslimits($scope.numberOfItemsToDisplay);

             if ($scope.companysli.length > 0) {

                 $scope.$broadcast('scroll.infiniteScrollComplete');

             } else {
                 // console.log("gdfgdfgdfg");
                 $scope.numberOfItemsToDisplay = -1;
             }
         } else if ($scope.numberOfItemsToDisplay > -2) {

             $scope.numberOfItemsToDisplay = 1;
             $scope.$broadcast('scroll.infiniteScrollComplete');
         }
     };



     //   var MyDate_String_Value = "/Date(1480588450000)/";
     var date = "/Date(1481808480000)/";
     var pattern = /Date\(([^)]+)\)/;
     var results = pattern.exec(date);
     var dt = new Date(parseFloat(results[1]));
     var month = dt.getMonth();
     var day = dt.getDay();
     var currentdate = new Date();
     var NoOfDays = Math.round((currentdate - dt) / (1000 * 60 * 60 * 24));
     console.log(NoOfDays);

 })
 .controller('productCtrl', function ($scope, $stateParams, $sce, $state, $filter, $rootScope, loginService, $ionicLoading, $cordovaSocialSharing, $ionicPopup) {

     $scope.lang = $rootScope.lang;

     if ($scope.lang == "") {
         $scope.Reviews = "Reviews";
         $scope.details = "Details";
         $scope.Share = "Share";
         $scope.Report = "Report";
         $scope.Comments = "Comments";
         $scope.Write_Review = "Write Review";
     }

     if ($scope.lang == 1) {
         $scope.Reviews = "Reviews";
         $scope.details = "Details";
         $scope.Share = "Share";
         $scope.Report = "Report";
         $scope.Comments = "Comments";
         $scope.Write_Review = "Write Review";

     } else if ($scope.lang == 2) {

         $scope.Reviews = "Anmeldelser";
         $scope.details = "Detaljer";
         $scope.Share = "Del";
         $scope.Report = "Rapport";
         $scope.Comments = "Kommentarer";
         $scope.Write_Review = "Skriv anmeldelse";

     }


     $state.compids = JSON.parse($state.params.object);
     $scope.showlines($ionicLoading);
     $scope.comdetails = {};
     $scope.userdetails = loginService.isAuthenticated();
     console.log($scope.compids);
     $scope.minvalue = 0;
     $scope.maxvalue = 10;


     console.log(window.localStorage.getItem("langKey"));

     $scope.loginids = 0;
     if ($scope.userdetails.userid1 != "") {
         $scope.loginids = 1;
     }
     //$scope.$watch("minvalue", function () {
     //    alert('Value has changed !')

     //})

     $scope.ratingclass = function () {

         setTimeout(function () {
             $('.barra-nivel').each(function () {
                 //debugger;
                 var valorLargura2 = $(this).data('nivel');
                 //debugger;
                 var valorLargura = $(this).attr('data-nivel').replace("%", '');
                 //  alert(valorLargura);
                 // console.log(valorLargura);
                 // var bindpers = parseInt(valorLargura.replace("%", ''));
                 $(this).animate({
                     width: valorLargura2
                 });
                 var bindpers = parseInt(valorLargura);
                 var valorNivel = $(this).parent().parent().next().html("<span class='valor-nivel'>" + (bindpers / 10) + "</span>");

                 // var valorNivel = $(this).parent().parent().next().html("<span class='valor-nivel'>" + valorLargura + "</span>");

             });

             $('.barra-nivel').each(function () {
                 //debugger;
                 var x = $(this).attr('data-nivel').split('%');

                 if (x[0] <= 60) {
                     $(this).css('background', '#fb4803');

                     $(this).parent().parent().next().css('background', '#fb4803');
                 }
                 else if (x[0] > 60 && x[0] <= 80) {
                     $(this).css('background', '#f89b0f');
                     $(this).parent().parent().next().css('background', '#f89b0f');
                 }
                 else if (x[0] > 80) {
                     $(this).css('background', '#2fc12f');
                     $(this).parent().parent().next().css('background', '#2fc12f');
                 }
             });

             function collision($div1, $div2) {
                 var x1 = $div1.offset().left;
                 var w1 = 40;
                 var r1 = x1 + w1;
                 var x2 = $div2.offset().left;
                 var w2 = 40;
                 var r2 = x2 + w2;

                 if (r1 < x2 || x1 > r2) return false;
                 return true;

             }

             // // slider call

             $('#slider').slider({
                 range: true,
                 min: 0,
                 max: 10,
                 values: [0, 10],
                 slide: function (event, ui) {
                     // debugger;
                     $('.ui-slider-handle:eq(0) .price-range-min').html('' + ui.values[0]);
                     $('.ui-slider-handle:eq(1) .price-range-max').html('' + ui.values[1]);
                     $('.price-range-both').html('<i>' + ui.values[0] + ' - </i>' + ui.values[1]);

                     $scope.minvalue = ui.values[0];
                     $scope.maxvalue = ui.values[1];


                     if (ui.values[0] == ui.values[1]) {
                         $('.price-range-both i').css('display', 'none');
                     } else {
                         $('.price-range-both i').css('display', 'inline');
                     }

                     //

                     if (collision($('.price-range-min'), $('.price-range-max')) == true) {
                         $('.price-range-min, .price-range-max').css('opacity', '0');
                         $('.price-range-both').css('display', 'block');
                     } else {
                         $('.price-range-min, .price-range-max').css('opacity', '1');
                         $('.price-range-both').css('display', 'none');
                     }

                 },
                 stop: function (event, ui) {
                     $scope.minvalue = ui.values[0];
                     $scope.maxvalue = ui.values[1];
                     // alert($scope.minvalue);
                     //alert($scope.maxvalue);

                 }

             });

             $('.ui-slider-range').append('<span class="price-range-both value"><i>' + $('#slider').slider('values', 0) + ' - </i>' + $('#slider').slider('values', 1) + '</span>');

             $('.ui-slider-handle:eq(0)').append('<span class="price-range-min value">' + $('#slider').slider('values', 0) + '</span>');

             $('.ui-slider-handle:eq(1)').append('<span class="price-range-max value">' + $('#slider').slider('values', 1) + '</span>');
             timeinter = 0;

         }, 3);
     }
     // loginService.companydetails(1).then(function (result) {
     loginService.companydetails($state.compids.companyprofileid, $scope.loginids).then(function (result) {
         //    console.log(result);

         $ionicLoading.hide();
         $scope.comdetails.SurvID = result.data.data.Comp.SurvID;
         $rootScope.loginreview = $state.compids.companyprofileid;
         if (result.data.status == true) {
             //debugger;
             $scope.comdetails = result.data.data.Comp;
             $scope.companyid = result.data.data.Comp.CmpyProflesID;
             $scope.comdetails.SurvID = result.data.data.Comp.SurvID;
             $scope.userlist = result.data.data.Comp.UserLst;
             $scope.LastUsed = result.data.data.LastUsed;
             $scope.SurveyTitle = result.data.data.Comp.SurveyTitle;
             $scope.SurveyDesc = result.data.data.Comp.CmpyDesc;
             $scope.CmpyProflesID = result.data.data.Comp.CmpyProflesID;
             $scope.chkUsersurveycomplete = result.data.data.ChkUserSurveycomplete
             $scope.statusval = result.data.status;
             $scope.userrating = result.data.data.Comp.UserLst.UserRating;
             $scope.range_userlist = 0;
             //debugger;
         } else {
             // console.log(result.data.data.CmpyImgStr)
             $scope.comdetails.CmpyRate = 0;
             $scope.comdetails.CmpyName = result.data.data.CmpyName;
             $scope.comdetails.CmpyCat = result.data.data.CmpyCat;
             $scope.comdetails.SurvID = result.data.data.SurvID;
             $scope.statusval = result.data.status;
             $scope.CmpyImgStr = result.data.data.CmpyImgStr;
             $scope.userlist = result.data.data.UserLst;

         }
         $scope.ratingclass();

         // $scope.cmpimage=

     });

     //$scope.$watch('minvalue', function () {
     //    alert('hey, myVar has changed!');
     //});
     //$scope.$watch('maxvalue', function () {
     //    alert($scope.maxvalue);
     //});


     $scope.range_values = function () {
         var min = $("#slider").slider("option", "min"),
        max = $("#slider").slider("option", "max")
         // alert("min: " + min + " max: " + max);
         //loginService.getrange_values(minvalue, maxvalue,$scope.companyid).then(function(rangevalues) {

         //  if (rangevalues.data.status === true) {
         //     $scope.userslist = rangevalues.data.model;
         //       $scope.range_userlist = 1;
         //   }
         //   $scope.ratingclass();
         //});
     }

     loginService.getcountryname().then(function (result) {
         // console.log(result);
         if (result.data.status = true) {
             $scope.getcountry = result.data.data;
             console.log(result);

             $scope.allcountry = $scope.getcountry[0];
         }
     });

     $scope.Community = function () {
         //alert(productid);
         // $rootScope.loginreview = val;
         var obj = { companyprofileid: $scope.comdetails.SurvID, catgorey: 0 }
         $state.go('app.community', { object: JSON.stringify(obj) });
         // $state.go('app.community');
     }

     $scope.wrireview = function () {
          //alert(val);
         // $rootScope.loginreview = val;
         console.log($rootScope.loginreview);
         $state.go('app.login');
     }

     $scope.users = {};
     //$scope.reportasspam = "";
     $scope.showdialog = function (responceid) {

         var language = $scope.lang;
         if (language == '') {
             $scope.notify = "Notify Buzz Bee";
             $scope.msgs = "You have just chosen to notify Buzz Bee because you think that this review violates Buzz Bees guidelines or rules.";
             $scope.pla = "Please provide as mouch infomation as possible in the text box below(min.75 characters)";
             $scope.ph = "Please describe why you believe this review require our attention. Does it e.g. contain offending language or do you believe it is fake?";
             $scope.cancel = 'Cancel';
             $scope.submit = 'Submit';
             $scope.alertmessage = 'ALERT MESSAGE';
             $scope.templatess = 'Please give some reason';
         } else if (language == 1) {
             $scope.notify = "Notify Buzz Bee";
             $scope.msgs = "You have just chosen to notify Buzz Bee because you think that this review violates Buzz Bees guidelines or rules.";
             $scope.pla = "Please provide as mouch infomation as possible in the text box below(min.75 characters)";
             $scope.ph = "Please describe why you believe this review require our attention. Does it e.g. contain offending language or do you believe it is fake?";
             $scope.cancel = 'Cancel';
             $scope.submit = 'Submit';
             $scope.alertmessage = 'ALERT MESSAGE';
             $scope.templatess = 'Please give some reason';
         } else if (language == 2) {

            // this.content = { ph: $sce.trustAsHtml('Beskriv venligst hvorfor du mener, at denne anmeldelse kræver vores opmærksomhed. Indeholder den f.eks. krænkende sprog eller mener du den er falsk ...?') };
           //  this.content = { pla: $sce.trustAsHtml('Angiv så meget information som muligt i nnedenstående tekstboks (minimum 75 tegn i din beskrivelse).') };
           //  this.content = {$sce.trustAsHtml('Du har lige valgt at underrette Buzz Bee, fordi du mener, at denne anmeldelse overtræder Buzz Bees retningslinjer eller regler.') };
            // var rr = document.write('&aring;');
             $scope.notify = "Undret Buzz Bee";

            // $scope.testText = 's&aring;'


            //  $scope.msgs =$sce.trustAsHtml("Du har lige valgt at underrette Buzz Bee, fordi du mener, at denne anmeldelse overtr&aelig;der Buzz Bees retningslinjer eller regler.");
            // $scope.pla = $sce.trustAsHtml($scope.testText);
            // $scope.ph = $sce.trustAsHtml("Beskriv venligst hvorfor du mener, at denne anmeldelse kr&aelig;ver vores opm&aelig;rksomhed. Indeholder den f.eks. kr&aelig;nkende sprog eller mener du den er falsk ...?");
             $scope.cancel = "Annuller";
             $scope.submit = "Godkend";
             $scope.alertmessage = "ADVARSELSMEDDELELSE";
             $scope.templatess = "Giv en eller anden grund";
         }





         var myPopup = $ionicPopup.show({
             template: '<div class="pop2"><div style="background-color: #f89b0f;padding: 13px;"><h5 style="margin: 0;color:#fff;">{{notify}}</h5></div><div class="fon-ico"></div><div class="text" style="padding: 10px;"><h5 style="font-weight: normal;color: #666;"><span ng-if="lang==2">Du har lige valgt at underrette Buzz Bee, fordi du mener, at denne anmeldelse overtr&aelig;der Buzz Bees retningslinjer eller regler.</span><span ng-if="lang!=2 || lang == 1">{{msgs}}</span></br></br><span ng-if="lang==2">Angiv s&aring; meget information som muligt i nedenst&aring;ende tekstboks (minimum 75 tegn i din beskrivelse).</span><span ng-if="lang !=2 || lang == 1">{{pla}}</span></h5><textarea ng-if="lang==2" rows="5" cols="45" placeholder="Beskriv venligst hvorfor du mener, at denne anmeldelse kr&aelig;ver vores opm&aelig;rksomhed. Indeholder den f.eks. kr&aelig;nkende sprog eller mener du den er falsk ...?"  ng-model="users.reportasspam" minlength="75" style="border:1px solid #ddd;" required></textarea><textarea ng-if="lang != 2 || lang== 1 " rows="5" cols="45" placeholder="{{ph}}"  ng-model="users.reportasspam" minlength="75" style="border:1px solid #ddd;" required></textarea></div><div class="sabtn"></div></div></div>',
             cssClass: 'notify',
             scope: $scope,
             buttons: [
               { text: $scope.cancel },
               {
                   text: $scope.submit,
                   type: 'button-positive',
                   onTap: function (e) {
                       qty = $scope.users.reportasspam;
                       if (!qty) {

                           var alertPopup = $ionicPopup.alert({
                               cssClass: 'alert_message',
                               title: $scope.alertmessage,
                               template: $scope.templatess
                           });

                           alertPopup.then(function (res) {
                               //console.log('Please enter 75 characters.');
                           });
                           e.preventDefault();
                       } else {
                           loginService.reportspam($scope.comdetails.SurvID, responceid, qty).then(function (result) {

                               debugger;

                               console.log(result);

                               $state.go('app.product');
                               $state.reload()

                           });

                           //   loginService.reportspam($scope.comdetails.SurvID,responceid, $scope.reportasspam).then(function (result) {
                           //     debugger;
                           //   console.log(result);
                           //  $ionicLoading.hide();

                           // });
                           //return $scope.data.wifi;
                       }
                   }
               }
             ]
         });
     }





     /* $scope.reportspams = function (responceid) {
         // debugger;
          loginService.reportspam($scope.comdetails.SurvID, responceid, $scope.users.reportasspam).then(function (result) {
     
              debugger;
            
              console.log(result);
            
              $state.go('app.product');
 
 
          });
  }*/




     $scope.survycompaney = function (val) {
         // alert(val)
         $state.go('app.survyResponses', { object: val });
     }
     $scope.viewcompaney = function (surrespid) {
         //  alert(surveyid)
         var obj = { SurID: surrespid, SveyID: $scope.comdetails.SurvID }
         $state.go('app.reviewResponses', { object: JSON.stringify(obj) });
         // $state.go('app.reviewResponses', { object: val });
     }

     $scope.OtherShare = function (msg) {
         //window.plugins.socialsharing.share('Digital Signature Maker', 'test', null, 'https://play.google.com/store/apps/details?id=com.prantikv.digitalsignaturemaker');
         //alert($scope.userlist[msg].UserReview);
         // $scope.userlist[msg].UserReview;
         $cordovaSocialSharing.share($scope.userlist[msg].UserReview, 'subeject', null, 'https://www.buzzbee.mobi/en/Home/Index');
         // $cordovaSocialSharing.share({ "message": "This is your message" }, { "subject": "This is your subject" }, { "fileuplaod": null }, { "url": "http://blog.nraboy.com" });
         //$cordovaSocialSharing.shareViaFacebook($scope.userlist[msg].UserReview, null, "https://www.thepolyglotdeveloper.com");
     }


     $scope.timeconver = function (dates) {
        
         var pattern = /Date\(([^)]+)\)/;
         var results = pattern.exec(dates);
         var dt = new Date(parseFloat(results[1]));
         return dt;
         var MyDate_String_Value = dates;

         var value = new Date
         (
              parseInt(MyDate_String_Value.replace(/(^.*\()|([+-].*$)/g, ''))
         );
         var datetime = dt.getMonth() +
                      1 +
                    "/" +
        dt.getDate() +
                    "/" +
    dt.getFullYear();

         var curtdob = new Date(dt);
         // debugger;
         curtdob = curtdob.toDateString();
         return curtdob;
     }
 })
    .factory('autoCompleteDataService', [function () {
        return {
            getSource: function () {
                return ['India', 'Kenya', 'bananas', "New Zealand", "United States"];
            }
        }
    }])

.directive('autoComplete', function ($timeout) {
    return {
        restrict: "A",
        scope: {
            uiItems: "="
        },
        link: function (scope, iElement, iAttrs) {
            scope.$watchCollection('uiItems', function (val) {

                iElement.autocomplete({
                    source: scope.uiItems,
                    select: function () {
                        $timeout(function () {
                            // return;
                            // console.log(iAttrs);
                            //iElement.trigger('input');

                        }, 0);
                    }
                });
            });

        }
    }

})
    .controller('DefaultCtrl', function ($scope, loginService, $cordovaSocialSharing, base64) {
        $scope.names = [];
        $("#example_id").ionRangeSlider({
            type: "double",
            min: 0,
            max: 10000,
            step: 500,
            grid: true,
            grid_snap: true
        });
        //console.log($scope.encoded);
        $scope.changecountry = function (autodata) {
            loginService.searchcountry(autodata).then(function (result) {
                $scope.names = result.data.data;
                console.log($scope.names);
            });

        }

        $scope.OtherShare = function () {

            var result = loginService.testimage();

            console.log(result);

            //window.plugins.socialsharing.share('Digital Signature Maker', 'test', null, 'https://play.google.com/store/apps/details?id=com.prantikv.digitalsignaturemaker');
            //alert();
            // $cordovaSocialSharing.share('Test Share', 'subeject', null, 'http://google.com');
            // $cordovaSocialSharing.share({ "message": "This is your message" }, { "subject": "This is your subject" }, { "fileuplaod": null }, { "url": "http://blog.nraboy.com" });
            //   $cordovaSocialSharing.shareViaFacebook("This is your message",null, "https://www.thepolyglotdeveloper.com");
        }


    })


    .controller('registrationCtrl1', function ($scope, loginService, $rootScope, ionicDatePicker, HelperService, $state, $ionicActionSheet, ImageService, $ionicLoading) {

        $scope.lang = window.localStorage.getItem("langKey");


        $scope.language = window.localStorage.getItem("langKey1");
        ChangeValues($scope.language)
        $rootScope.$watch('lang', function (value) {
            //alert(value);

            if (value != "" || value == null || value == undefined) {
                ChangeValues(value)
            }

        });
        function ChangeValues(value) {

            if (value == "" || value == null || value == undefined) {

                $scope.Registration = "Registration";
                $scope.firstname = "First Name";
                $scope.lastname = "Last Name";
                $scope.email = "Email";
                $scope.password = "Password";
                $scope.confirmpassword = "Confirm Password";
                $scope.countrycodes = "Country Code";
                $scope.mobile = "Mobile";
                $scope.cancel = "Cancel";
                $scope.next = "Submit";
                $scope.ccodes = "Country codes";
                $scope.lang = value;
            }

            if (value == 1) {
                $scope.Registration = "Registration";
                $scope.firstname = "First Name";
                $scope.lastname = "Last Name";
                $scope.email = "Email";
                $scope.password = "Password";
                $scope.confirmpassword = "Confirm Password";
                $scope.countrycodes = "Country Code";
                $scope.mobile = "Mobile";
                $scope.cancel = "Cancel";
                $scope.next = "Submit";
                $scope.ccodes = "Country codes";
                $scope.lang = value;

            } else if (value == 2) {

                $scope.Registration = "Tilmelding";
                $scope.firstname = "Fornavn";
                $scope.lastname = "Efternavn";
                $scope.email = "E-mail";
                $scope.password = "Adgangskode";
                $scope.countrycodes = "Landekode";
                $scope.mobile = "Mobil nummer";
                $scope.cancel = "Annuller";
                $scope.next = "Godkend";
                $scope.ccodes = "landekode";
                $scope.lang = value;

            }
        }


      





        $scope.user = {};
        $scope.model2 = {};

        $scope.model2.Design = "Consumer";
        $scope.statename = 0;
        /*  var curtdob = new Date();
          $scope.user.dob = curtdob.toDateString();
      
          $scope.getBirthYearStr = function () {
      
              return HelperService.getMonthText($scope.user.dob) + "/" + HelperService.getDayText($scope.user.dob) + "/" + HelperService.getYearText($scope.user.dob);
          }
         // $scope.model2.DOB = $scope.getBirthYearStr(); //WORKING by venkate 31-03-2017
          $scope.model2.DOB = '';  //change by suman 31-03-2017
          var ipObj1 = {
              callback: function (val) {  //Mandatory
      
                  var dob = new Date(val);
                  $scope.user.dob = dob.toDateString();
                  $scope.model2.DOB = $scope.getBirthYearStr();
                 
              },
              disabledDates: [            //Optional
                new Date(2016, 2, 16),
                new Date(2015, 3, 16),
                new Date(2015, 4, 16),
                new Date(2015, 5, 16),
                new Date('Wednesday, August 12, 2015'),
                new Date("08-16-2016"),
                new Date(1439676000000)
              ],
              from: new Date(1950, 1, 1), //Optional
              to: new Date(2018, 10, 30), //Optional
              inputDate: new Date(),      //Optional
              mondayFirst: true,          //Optional
              disableWeekdays: [0],       //Optional
              closeOnSelect: false,       //Optional
              templateType: 'popup'       //Optional
          };*/


        $scope.cancellreg = function () {
            $state.go('app.home');
        }
        var onFailureCallback = function () {
        };
        //$scope.emailFormat = /[a-z0-9!#$%&'*+=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/g;
        //  ng-pattern="emailFormat" 
        $scope.blurfunction = function (e) {
            $scope.emailFormat = /[a-z0-9!#$%&'*+=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/g;
            if (!$scope.emailFormat.test(e.target.value)) {
                // // console.log($event.target.value);
                HelperService.showFailurePopup(true, onFailureCallback, $scope, "Please enter valid emailid");
            }
        }

        $scope.blurempty = function (e) {

            if (e.target.value == "") {

                HelperService.showFailurePopup(true, onFailureCallback, $scope, "Please enter " + $(e.target).closest('tr').children('td').first().text());
            }
        }


        var langid = $scope.language;

        loginService.getcountryname(langid).then(function (result) {

            if (result.data.status = true) {
                $scope.getcountry = result.data.CountryCodeList;
                console.log(result);

                $scope.allcountry = $scope.getcountry[0];

            }
        });

        /* $scope.getPhoto = function () {
             navigator.camera.getPicture(onSuccess, onFail, {
                 quality: 75, targetWidth: 320,
                 targetHeight: 320, destinationType: 0
             });
             //destination type was a base64 encoding
             function onSuccess(imageData) {
                 //debugger;
                 //preview image on img tag
              $('#image-preview').attr('src', "data:image/jpeg;base64," + imageData);
                 //setting scope.lastPhoto 
              $scope.lastPhoto = dataURItoBlob("data:image/jpeg;base64," + imageData);
             console.log($scope.lastPhoto);
             }
             function onFail(message) {
                 alert('Failed because: ' + message);
             }
         }
         function dataURItoBlob(dataURI) {
             // convert base64/URLEncoded data component to raw binary data held in a string
             var byteString = atob(dataURI.split(',')[1]);
             var mimeString = dataURI.split(',')[0].split(':')[1].split(';')[0]
     
             var ab = new ArrayBuffer(byteString.length);
             var ia = new Uint8Array(ab);
             for (var i = 0; i < byteString.length; i++) {
                 ia[i] = byteString.charCodeAt(i);
             }
     
             var bb = new Blob([ab], { "type": mimeString });
             return bb;
         }*/


        $scope.openDatePicker = function () {
            ionicDatePicker.openDatePicker(ipObj1);
        };
        loginService.logout();
        $scope.model2.CountryCode = 0;

        $scope.regstration = function () {

            loginService.logout();

            var firstname = document.getElementById("FirstName").value;
            var lastname = document.getElementById("LastName").value;
            var email = document.getElementById("Email").value;
            var password = document.getElementById("Password").value;
            var cpass = document.getElementById("Password2").value;
            var countrycode = document.getElementById("CountryCode");
            var mobile = document.getElementById("Mobile").value;
            var strUser = countrycode.options[countrycode.selectedIndex].value;

            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            var em = regex.test(email);


            if (firstname == "" || lastname == "" || email == "" || password == "" || cpass == "" || strUser == 0 || mobile == "" || password != cpass || !em || password.length < 8) {
                if (firstname == "") {
                    $('#FirstName').css('border', '1px solid red');

                }

                if (lastname == "") {
                    $('#LastName').css('border', '1px solid red');

                }




                if (email == "") {
                    $('#Email').css('border', '1px solid red');
                    $scope.emailid = "Please enter valid email";

                } else if (!em) {

                    $('#Email').css('border', '1px solid red');
                    $scope.emailid = "Please enter valid email";
                } else {
                    $scope.emailid = "";
                }


                if (password == "") {
                    $('#Password').css('border', '1px solid red');
                    $scope.pass = "Password should be atleast 8 characters"
                } else if (password.length < 8) {
                    $('#Password').css('border', '1px solid red');
                    $scope.pass = "Password should be atleast 8 characters"

                } else {
                    $scope.pass = '';
                }

                if (cpass == "") {
                    $('#Password2').css('border', '1px solid red');
                } else if (password != cpass) {
                    $('#Password2').css('border', '1px solid red');
                    $scope.cpass = "Password and confirm Password miss match"
                } else {
                    $('#Password2').css('border', '1px solid #ddd');
                    $scope.cpass = '';
                }

                if (strUser == 0) {
                    $('#CountryCode').css('border', '1px solid red');

                } else {
                    $('#CountryCode').css('border', '1px solid #ddd');
                }

                if (mobile == "") {
                    $('#Mobile').css('border', '1px solid red');
                }
                return false;
            } else {
                $scope.showlines($ionicLoading);
                loginService.registrations($scope.model2).then(function (responcedata) {

                    //debugger;


                    if (responcedata.data.data.userId != "") {

                        // debugger;
                        responcedata.data.data.userKey = responcedata.data.data.userKey.replace(/^"(.*)"$/, '$1');
                        loginService.isAlreadylogin(responcedata.data.data.userId, responcedata.data.data.userKey).then(function (result) {
                            $ionicLoading.hide();
                            // $rootScope.name = result.data.data.DispName;
                            // $rootScope.img = result.data.data.ProfileImage;
                            // $state.go('app.optional');

                            $state.go('app.optional', { object: JSON.stringify({ opt: 'reg', UserProfileID: responcedata.data.data.UserProfileID }) });
                        });
                    }

                }, function (errmsg) {
                    // debugger;
                    $ionicLoading.hide();
                    HelperService.showFailurePopup(true, onFailureCallback, $scope, "email already exist");
                    // $ionicLoading.hide();
                });
            }

        }
    })



    .controller('registrationCtrl', function ($scope, loginService, $rootScope, ionicDatePicker, HelperService, $state, $ionicActionSheet, ImageService, $ionicLoading) {

        $scope.lang = $rootScope.lang;


        $scope.language = window.localStorage.getItem("langKey1");
        ChangeValues($scope.language)
        $rootScope.$watch('lang', function (value) {
            //alert(value);

            if (value != "") {
                ChangeValues(value)
            }

        });
        function ChangeValues(value) {

            if (value == "" || null || value == undefined) {

                $scope.Registration = "Registration";
                $scope.firstname = "First Name";
                $scope.lastname = "Last Name";
                $scope.email = "Email";
                $scope.password = "Password";
                $scope.confirmpassword = "Confirm Password";
                $scope.countrycodes = "Country Code";
                $scope.mobile = "Mobile";
                $scope.cancel = "Cancel";
                $scope.next = "Submit";
                $scope.ccodes = "Country codes";
                $scope.lang = value;

            }

            if (value == 1 || null || value == undefined) {
                $scope.Registration = "Registration";
                $scope.firstname = "First Name";
                $scope.lastname = "Last Name";
                $scope.email = "Email";
                $scope.password = "Password";
                $scope.confirmpassword = "Confirm Password";
                $scope.countrycodes = "Country Code";
                $scope.mobile = "Mobile";
                $scope.cancel = "Cancel";
                $scope.next = "Submit";
                $scope.ccodes = "Country codes";
                $scope.lang = value;

            } else if (value == 2 || null || value == undefined) {

                $scope.Registration = "Tilmelding";
                $scope.firstname = "Fornavn";
                $scope.lastname = "Efternavn";
                $scope.email = "E-mail";
                $scope.password = "Adgangskode";
                $scope.countrycodes = "Landekode";
                $scope.mobile = "Mobil nummer";
                $scope.cancel = "Annuller";
                $scope.next = "Godkend";
                $scope.ccodes = "landekode";
                $scope.lang = value;

            }
        }





        $scope.user = {};
        $scope.model2 = {};

        $scope.model2.Design = "Consumer";
        $scope.statename = 0;
        /*  var curtdob = new Date();
          $scope.user.dob = curtdob.toDateString();
      
          $scope.getBirthYearStr = function () {
      
              return HelperService.getMonthText($scope.user.dob) + "/" + HelperService.getDayText($scope.user.dob) + "/" + HelperService.getYearText($scope.user.dob);
          }
         // $scope.model2.DOB = $scope.getBirthYearStr(); //WORKING by venkate 31-03-2017
          $scope.model2.DOB = '';  //change by suman 31-03-2017
          var ipObj1 = {
              callback: function (val) {  //Mandatory
      
                  var dob = new Date(val);
                  $scope.user.dob = dob.toDateString();
                  $scope.model2.DOB = $scope.getBirthYearStr();
                 
              },
              disabledDates: [            //Optional
                new Date(2016, 2, 16),
                new Date(2015, 3, 16),
                new Date(2015, 4, 16),
                new Date(2015, 5, 16),
                new Date('Wednesday, August 12, 2015'),
                new Date("08-16-2016"),
                new Date(1439676000000)
              ],
              from: new Date(1950, 1, 1), //Optional
              to: new Date(2018, 10, 30), //Optional
              inputDate: new Date(),      //Optional
              mondayFirst: true,          //Optional
              disableWeekdays: [0],       //Optional
              closeOnSelect: false,       //Optional
              templateType: 'popup'       //Optional
          };*/


        $scope.cancellreg = function () {
            $state.go('app.home');
        }
        var onFailureCallback = function () {
        };
        //$scope.emailFormat = /[a-z0-9!#$%&'*+=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/g;
        //  ng-pattern="emailFormat" 
        $scope.blurfunction = function (e) {
            $scope.emailFormat = /[a-z0-9!#$%&'*+=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/g;
            if (!$scope.emailFormat.test(e.target.value)) {
                // // console.log($event.target.value);
                HelperService.showFailurePopup(true, onFailureCallback, $scope, "Please enter valid emailid");
            }
        }

        $scope.blurempty = function (e) {

            if (e.target.value == "") {

                HelperService.showFailurePopup(true, onFailureCallback, $scope, "Please enter " + $(e.target).closest('tr').children('td').first().text());
            }
        }
        var langid = 1;
        if ($scope.language != '' || $scope.language != undefined) {
            var langid = $scope.language;
        }
        

        loginService.getcountryname(langid).then(function (result) {
            debugger;
            if (result.data.status = true) {
                $scope.getcountry = result.data.CountryCodeList;
                console.log(result);

                $scope.allcountry = $scope.getcountry[0];

            }
        });

        /* $scope.getPhoto = function () {
             navigator.camera.getPicture(onSuccess, onFail, {
                 quality: 75, targetWidth: 320,
                 targetHeight: 320, destinationType: 0
             });
             //destination type was a base64 encoding
             function onSuccess(imageData) {
                 //debugger;
                 //preview image on img tag
              $('#image-preview').attr('src', "data:image/jpeg;base64," + imageData);
                 //setting scope.lastPhoto 
              $scope.lastPhoto = dataURItoBlob("data:image/jpeg;base64," + imageData);
             console.log($scope.lastPhoto);
             }
             function onFail(message) {
                 alert('Failed because: ' + message);
             }
         }
         function dataURItoBlob(dataURI) {
             // convert base64/URLEncoded data component to raw binary data held in a string
             var byteString = atob(dataURI.split(',')[1]);
             var mimeString = dataURI.split(',')[0].split(':')[1].split(';')[0]
     
             var ab = new ArrayBuffer(byteString.length);
             var ia = new Uint8Array(ab);
             for (var i = 0; i < byteString.length; i++) {
                 ia[i] = byteString.charCodeAt(i);
             }
     
             var bb = new Blob([ab], { "type": mimeString });
             return bb;
         }*/


        $scope.openDatePicker = function () {
            ionicDatePicker.openDatePicker(ipObj1);
        };
        loginService.logout();
        $scope.model2.CountryCode = 0;

        $scope.regstration = function () {

            loginService.logout();

            var firstname = document.getElementById("FirstName").value;
            var lastname = document.getElementById("LastName").value;
            var email = document.getElementById("Email").value;
            var password = document.getElementById("Password").value;
            var cpass = document.getElementById("Password2").value;
            var countrycode = document.getElementById("CountryCode");
            var mobile = document.getElementById("Mobile").value;
            var strUser = countrycode.options[countrycode.selectedIndex].value;

            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            var em = regex.test(email);


            if (firstname == "" || lastname == "" || email == "" || password == "" || cpass == "" || strUser == 0 || mobile == "" || password != cpass || !em || password.length < 8) {
                if (firstname == "") {
                    $('#FirstName').css('border', '1px solid red');

                }

                if (lastname == "") {
                    $('#LastName').css('border', '1px solid red');

                }




                if (email == "") {
                    $('#Email').css('border', '1px solid red');
                    $scope.emailid = "Please enter valid email";

                } else if (!em) {

                    $('#Email').css('border', '1px solid red');
                    $scope.emailid = "Please enter valid email";
                } else {
                    $scope.emailid = "";
                }


                if (password == "") {
                    $('#Password').css('border', '1px solid red');
                    $scope.pass = "Password should be atleast 8 characters"
                } else if (password.length < 8) {
                    $('#Password').css('border', '1px solid red');
                    $scope.pass = "Password should be atleast 8 characters"

                } else {
                    $scope.pass = '';
                }

                if (cpass == "") {
                    $('#Password2').css('border', '1px solid red');
                } else if (password != cpass) {
                    $('#Password2').css('border', '1px solid red');
                    $scope.cpass = "Password and confirm Password miss match"
                } else {
                    $('#Password2').css('border', '1px solid #ddd');
                    $scope.cpass = '';
                }

                if (strUser == 0) {
                    $('#CountryCode').css('border', '1px solid red');

                } else {
                    $('#CountryCode').css('border', '1px solid #ddd');
                }

                if (mobile == "") {
                    $('#Mobile').css('border', '1px solid red');
                }
                return false;
            } else {
                $scope.showlines($ionicLoading);
                loginService.registrations($scope.model2).then(function (responcedata) {

                    //debugger;


                    if (responcedata.data.data.userId != "") {

                        // debugger;
                        responcedata.data.data.userKey = responcedata.data.data.userKey.replace(/^"(.*)"$/, '$1');
                        loginService.isAlreadylogin(responcedata.data.data.userId, responcedata.data.data.userKey).then(function (result) {
                            $ionicLoading.hide();
                            // $rootScope.name = result.data.data.DispName;
                            // $rootScope.img = result.data.data.ProfileImage;
                            // $state.go('app.optional');

                            $state.go('app.optional', { object: JSON.stringify({ opt: 'reg', UserProfileID: responcedata.data.data.UserProfileID }) });
                        });
                    }

                }, function (errmsg) {
                    // debugger;
                    $ionicLoading.hide();
                    HelperService.showFailurePopup(true, onFailureCallback, $scope, "email already exist");
                    // $ionicLoading.hide();
                });
            }

        }
    })
    .controller('optionalCtrl', function ($scope, $filter, loginService, $rootScope, ionicDatePicker, $ionicPopup, HelperService, $state, $ionicActionSheet, ImageService) {


        $scope.lang = $rootScope.lang;

        if ($scope.lang == "" || $scope.lang == undefined) {
            $scope.UpdateDeatils = "Update Details";
            $scope.DateOfBirth = "Date Of Birth";
            $scope.Gender = "Gender";
            $scope.City = "City";
            $scope.ZipCode = "ZipCode";
            $scope.UploadImage = "Upload Image";
            $scope.Cancel = "Cancel";
            $scope.Submit = "Submit";
            $scope.cancel = "Cancel";
            $scope.Update = "Update";

        }

        if ($scope.lang == 1) {
            $scope.UpdateDeatils = "Update Details";
            $scope.DateOfBirth = "Date Of Birth";
            $scope.Gender = "Gender";
            $scope.City = "City";
            $scope.ZipCode = "ZipCode";
            $scope.UploadImage = "Upload Image";
            $scope.Cancel = "Cancel";
            $scope.Submit = "Submit";
            $scope.cancel = "Cancel";
            $scope.Update = "Update";

        } else if ($scope.lang == 2) {
            $scope.UpdateDeatils = "Opdatering Detaljer";
            //$scope.DateOfBirth = "Fødselsdato";
            // $scope.Gender = "Køn";
            $scope.City = "By";
            $scope.ZipCode = "Postnummer";
            $scope.UploadImage = "Upload billede";
            $scope.Cancel = "Annuller";
            $scope.Submit = "Indsend";
            $scope.cancel = "Annuller";
            $scope.Update = "Opdater";

        }









        $scope.user = {};
        $scope.addres = {};
        $scope.getuserdetails = {};
        var curtdob = new Date();
        $scope.user.dob = curtdob.toDateString();

        $scope.getBirthYearStr = function () {

            return HelperService.getMonthText($scope.user.dob) + "/" + HelperService.getDayText($scope.user.dob) + "/" + HelperService.getYearText($scope.user.dob);
        }
        // $scope.model2.DOB = $scope.getBirthYearStr(); //WORKING by venkate 31-03-2017
        $scope.DOB = '';  //change by suman 31-03-2017
        $scope.getuserdetails.Gender = '';

        var ipObj1 = {
            callback: function (val) {  //Mandatory

                var dob = new Date(val);
                $scope.user.dob = dob.toDateString();
                $scope.DOB = $scope.getBirthYearStr();

            },
            disabledDates: [            //Optional
              new Date(2016, 2, 16),
              new Date(2015, 3, 16),
              new Date(2015, 4, 16),
              new Date(2015, 5, 16),
              new Date('Wednesday, August 12, 2015'),
              new Date("08-16-2016"),
              new Date(1439676000000)
            ],
            from: new Date(1950, 1, 1), //Optional
            to: new Date(2018, 10, 30), //Optional
            inputDate: new Date(),      //Optional
            mondayFirst: true,          //Optional
            disableWeekdays: [0],       //Optional
            closeOnSelect: false,       //Optional
            templateType: 'popup'       //Optional
        };


        $scope.openDatePicker = function () {
            ionicDatePicker.openDatePicker(ipObj1);
        };

        $scope.birthdate = '';
        loginService.getprofile().then(function (responcedata) {

            $scope.getuserdetails = responcedata.data.model;

            var pattern = /Date\(([^)]+)\)/;
            var results = pattern.exec(responcedata.data.model.DOB);
            var dt = new Date(parseFloat(results[1]));
            $scope.DOB = $filter('date')(new Date(dt), 'M/dd/y')
            // debugger;

            if (responcedata.data.model.Gender == 'Male') {
                $scope.getuserdetails.Gender = 'm';
            } else {

                $scope.getuserdetails.Gender = 'f';
            }

        });







        $state.compids = JSON.parse($state.params.object);
        // console.log($state.compids);
        if ($state.compids.opt == 'update') {

            loginService.GetProfileAddressDetailsBy($state.compids.UserProfileID).then(function (result) {
                //debugger;
                // console.log(result.data.AddressDetails);
                if (typeof result.data.AddressDetails === 'object') {
                    //  debugger;
                    $scope.addres = result.data.AddressDetails;
                }

                $scope.profileimage = result.data.ProfileImage;

                $scope.addres.UserProfileID = $state.compids.UserProfileID;
                $scope.updatevalue = 'update';
            });
        }

        //

        //start change by suman 06-06-2017
        $state.compidss = JSON.parse($state.params.object);
        if ($state.compidss.opt == 'reg') {
            //debugger;
            loginService.GetProfileAddressDetailsBy($state.compidss.UserProfileID).then(function (result) {

                // console.log(result.data.AddressDetails);
                if (typeof result.data.AddressDetails === 'object') {
                    //  debugger;
                    $scope.addres = result.data.AddressDetails;
                }

                $scope.profileimage = result.data.ProfileImage;

                $scope.addres.UserProfileID = $state.compids.UserProfileID;

                $scope.registeringvalue = 'reg';
            });
        }
        //end change by suman 06-06-2017


        loginService.getstateandcountry().then(function (result) {
            // debugger;
            //  console.log(result.data.data);
            $scope.countrynames = result.data.data;

        });
        $scope.statedropdown = function (stateid) {
            //console.log(stateid);
            loginService.getstateandcountry(stateid).then(function (result) {
                // result.data.data;
                if (result.data.data.length > 0) {
                    $scope.statename = 1;

                    $scope.StateNames = result.data.data;

                }
                // console.log($scope.companynames);
            });
        }

        $scope.fileuploaded = "";

        $scope.addMedia = function () {
            //debugger;
            $scope.hideSheet = $ionicActionSheet.show({
                buttons: [
                  { text: 'Take photo' },
                  { text: 'Photo from library' }
                ],
                titleText: 'Add images',
                cancelText: 'Cancel',
                buttonClicked: function (index) {
                    $scope.addImage(index);
                }
            });
        }



        // $scope.imagedata = "";
        $scope.addImage = function (type) {

            $scope.hideSheet();
            // debugger;
            ImageService.handleMediaDialog(type).then(function (result) {
                // debugger;
                // console.log(result);
                $scope.profileimage = result;
                $scope.fileuploaded = result;
                // loginService.testimage(result).then(function (resultf) {
                //console.log(resultf);
                //$ionicLoading.hide();
                // });
            });

        }


        var onFailureCallback = function () {
        };
        $scope.regstration = function () {


            // alert($scope.fileuploaded);
            //console.log($state.compids.UserProfileID);

            loginService.optionalupdate($scope.addres, $scope.getuserdetails.Gender, $scope.DOB, $scope.fileuploaded, $state.compids.opt, $state.compids.UserProfileID).then(function (responcedata) {
                // debugger;

                if (responcedata.data.status == true && $state.compids.opt != 'update') {
                    //debugger;
                    loginService.logout();
                    $state.go('app.login');
                } else {

                    $state.go('app.home');

                }



            }, function (errmsg) {
                HelperService.showFailurePopup(errmsg, onFailureCallback, $scope, errmsg);
                // $ionicLoading.hide();
            });
        }
        $scope.skipreg = function () {
            if ($state.compids.opt != 'update') {
                loginService.logout();
            }
            $state.go('app.home');
        }

        $scope.delete_account = function () {
            var confirmPopup = $ionicPopup.confirm({
                template: 'you want to delete account?'
            });

            confirmPopup.then(function (res) {
                if (res) {

                    loginService.deleteaccount().then(function (responcedata) {
                        use = "";
                        loginService.logout(use);
                        $state.go('app.login');
                        location.reload();
                    });
                }
            })
        }
    })

   /* .controller('TestimgController',

  function MyController($scope, $http) {

      //the image
      $scope.uploadme;

      $scope.uploadImage = function() {
          var fd = new FormData();
          var imgBlob = dataURItoBlob($scope.uploadme);
          fd.append('file', imgBlob);
          
      }


      //you need this function to convert the dataURI
      function dataURItoBlob(dataURI) {
          var binary = atob(dataURI.split(',')[1]);
          var mimeString = dataURI.split(',')[0].split(':')[1].split(';')[0];
          var array = [];
          for (var i = 0; i < binary.length; i++) {
              array.push(binary.charCodeAt(i));
          }
          return new Blob([new Uint8Array(array)], {
              type: mimeString
          });
      }

  })
.directive("fileread", [
  function() {
      return {
          scope: {
              fileread: "="
          },
          link: function(scope, element, attributes) {
              element.bind("change", function(changeEvent) {
                  var reader = new FileReader();
                  reader.onload = function(loadEvent) {
                      scope.$apply(function() {
                          scope.fileread = loadEvent.target.result;
                      });
                  }
                  reader.readAsDataURL(changeEvent.target.files[0]);
              });
          }
      }
  }
])
    */
.controller('ReviewResponses', function ($scope, loginService, $rootScope, HelperService, $state, $ionicLoading) {

    $scope.showlines($ionicLoading);
    $state.compids = {};
    // $scope.SurRespID = JSON.parse($state.params.object);
    $state.compids = JSON.parse($state.params.object);

    //$scope.surveyresp = "venkhgjghj";
    $scope.comentdetilas = {};
    $scope.comentdetilas.surveyresp = ""
    loginService.surveyreviews($state.compids.SurID, $state.compids.SveyID).then(function (result) {
        console.log(result.data);
        $ionicLoading.hide();
        $scope.comentdetilas = result.data.model;
        $scope.surveyid = result.data.SurveyID;
        $scope.CheckUserReviews = result.data.CheckUserReviews;
        console.log($scope.CheckUserReviews);
        $scope.userresansid = result.data.model.UserResponceAnsID;
        $scope.userresid = result.data.model.UserResponceID;
        //$scope.userresid = result.data.model.UserResponceID;
        $scope.parensuryid = "";
        if ($scope.comentdetilas.SurvRespUserList.length > 0) {
            $scope.parensuryid = $scope.comentdetilas.SurvRespUserList[$scope.comentdetilas.SurvRespUserList.length - 1].UserResponceThreID;
        }

        //alert($scope.parensuryid);
        // $scope.questions2 = result.data.data.Qus;
    });

    $scope.reviewresponce = function () {
        //console.log(testvenki);
        console.log($scope.comentdetilas.surveyresp);
        loginService.reviewResponse($scope.userresansid, $scope.userresid, $scope.parensuryid, $scope.comentdetilas.surveyresp, $scope.surveyid).then(function (resdata) {

            var obj = { SurID: resdata.data.UserResponceAnsID, SveyID: resdata.data.SurveyId };

            $state.go($state.current, { object: JSON.stringify(obj) }, { reload: true, inherit: false });
            // $state.go('app.reviewResponses', { object: JSON.stringify(obj) });

            //  $state.go('app.home');
            // console.log(data);
            // $scope.res = data;
            // console.log($scope.res);
        });
    }
    $scope.cancellreg = function () {
        $state.go('app.home');
    }
})
.controller('ReviewResponsesCtrl', function ($scope, loginService, $state, $ionicLoading, $rootScope) {
    $scope.SurveyQuesID = "";
    $scope.SurveyQuesType = "";
    $scope.SurveyResp = "";
    $scope.SurRespID = JSON.parse($state.params.object);
    console.log($scope.SurRespID);
    $scope.showlines($ionicLoading);
    loginService.surveyquestions($scope.SurRespID).then(function (result) {
        debugger;
        console.log(result.data);
        $ionicLoading.hide();
        $scope.questions = result.data.surveyquest.SurveyQuestions;
        $scope.comapnydetails = result.data.Comapny;
        $scope.campanyid = result.data.Comapny.CompanyProfileID;
        $scope.surveyid = result.data.surveyquest.SurveyID;
       
       
        if ($scope.questions != "") {

            alert("sai");
        } 
        if ($scope.questions == "undefined") {

            alert("suman");
        }


    });

    $scope.submit = function () {
    //alert("suman");
        $scope.questions
        for (var i = 0; i < $scope.questions.length; i++) {




            if ($scope.questions[i].SurveyQuesType == "Rating") {
                $scope.SurveyQuesID = $scope.questions[i].SurveyQuesID;
                $scope.SurveyQuesType = $scope.questions[i].SurveyQuesType;

                $scope.SurveyResp = $rootScope.surrespon;
                console.log($rootScope.surrespon);
                //$scope.SurveyResp=$scope.SurveyResp1;
                $scope.SurveyRespTitle = "";
            }
            else {
                $scope.SurveyQuesID = $scope.questions[i].SurveyQuesID;
                $scope.SurveyQuesType = $scope.questions[i].SurveyQuesType;
                $scope.SurveyRespTitle = $scope.questions[i].SurveyRespTitle;
                $scope.SurveyResp = $scope.questions[i].SurveyResp;
            }




        };
        loginService.surveyResponse($scope.SurveyQuesID, $scope.SurveyQuesType, $scope.SurveyResp, $scope.surveyid, $scope.campanyid, $scope.SurveyRespTitle).then(function (resdata) {
            console.log(resdata.data.data.SurveyID);
            //$scope.res = data;
            if (resdata.data.data.TotQustCom == false) {
                $state.go($state.current, { object: $scope.SurRespID }, { reload: true, inherit: false });
            } else {
                $state.go('app.home')
            }
            // $state.go('app.survyResponses', { object: $scope.SurRespID });
            //  console.log($scope.res);
        });
        console.log($scope.SurveyQuesID);

        //console.log($scope.questions);

    }

    $scope.RatingChange = function (id, option) {
        // alert(id);
        $rootScope.surrespon = option;
        $("#SurveyQuesID_2").val(option);
        $(".rt").find("span").removeClass("red");
        $(".rt").find("span").removeClass("orange");
        $(".rt").find("span").removeClass("green");
        //$("#" + id).addClass("act");
        for (var i = 0; i < $(".rt").find("span").length; i++) {

            if (option <= 6) {
                $(".rt").find("span").eq(i).addClass("red");
                $("#" + id).removeClass("green");
                $("#" + id).removeClass("orange");
                $("#" + id).addClass("red");

            }
            if (option >= 7 && option <= 8) {
                $(".rt").find("span").eq(i).addClass("orange");
                $("#" + id).removeClass("red");
                $("#" + id).removeClass("green");
                $("#" + id).addClass("orange");
            }
            if (option >= 9 && option <= 10) {
                $(".rt").find("span").eq(i).addClass("green");
                $("#" + id).removeClass("red");
                $("#" + id).removeClass("orange");
                $("#" + id).addClass("green");
            }
            if ($(".rt").find("span")[i].id == id) {
                return;
            }
        }
    }




    $scope.cancellreg = function () {
        $state.go('app.home');
    }
})
    .controller('Reviewrespocomant', function ($scope, loginService, $state, $ionicLoading, $rootScope) {
        $scope.SurveyQuesID = [];
        $scope.SurveyQuesType = [];
        $scope.SurveyResp = [];
        $scope.SurRespID = JSON.parse($state.params.object);
        console.log($scope.SurRespID);
        $scope.showlines($ionicLoading);
        loginService.surveyquestions($scope.SurRespID).then(function (result) {
            console.log(result.data);
            $ionicLoading.hide();
            $scope.questions = result.data.data.Qus.SurveyQuestions;
            $scope.campanyid = result.data.data.Comp.CompanyProfileID;
            $scope.surveyid = result.data.data.Qus.SurveyID;
        });
        $scope.submit = function () {
            $scope.questions
            for (var i = 0; i < $scope.questions.length; i++) {

                $scope.SurveyQuesID.push($scope.questions[i].SurveyQuesID);
                $scope.SurveyQuesType.push($scope.questions[i].SurveyQuesType);

                if ($scope.SurveyQuesType[i] == "Rating") {
                    $scope.SurveyResp1 = $rootScope.surrespon;
                    console.log($rootScope.surrespon);
                    $scope.SurveyResp.push($scope.SurveyResp1);
                }
                else {
                    $scope.SurveyResp.push($scope.questions[i].SurveyResp);
                }




            };
            loginService.surveyResponse($scope.SurveyQuesID, $scope.SurveyQuesType, $scope.SurveyResp, $scope.surveyid, $scope.campanyid).then(function (data) {
                console.log(data);
                $scope.res = data;
                console.log($scope.res);
            });
            console.log($scope.SurveyQuesID);

            //console.log($scope.questions);

        }


    })
    .controller('updateprofile', function ($scope, loginService, $rootScope, ionicDatePicker, HelperService, $state, $ionicActionSheet, ImageService, $ionicLoading) {
        $scope.showlines($ionicLoading);


        $scope.lang = window.localStorage.getItem("langKey1");



        if ($scope.lang == "" || $scope.lang == null) {
            $scope.Registration = "Registration";
            $scope.firstname = "First Name";
            $scope.lastname = "Last Name";
            $scope.email = "Email";
            $scope.password = "Password";
            $scope.confirmpassword = "Confirm Password";
            $scope.countrycodes = "Country Code";
            $scope.mobile = "Mobile";
            $scope.cancel = "Cancel";
            $scope.next = "Next";
            $scope.ccodes = "Country codes";
        }

        if ($scope.lang == 1) {
            $scope.Registration = "Registration";
            $scope.firstname = "First Name";
            $scope.lastname = "Last Name";
            $scope.email = "Email";
            $scope.password = "Password";
            $scope.confirmpassword = "Confirm Password";
            $scope.countrycodes = "Country Code";
            $scope.mobile = "Mobile";
            $scope.cancel = "Cancel";
            $scope.next = "Submit";
            $scope.ccodes = "Country codes";
        } else if ($scope.lang == 2) {
            $scope.Registration = "Opdater profil";
            $scope.firstname = "Fornavn";
            $scope.lastname = "Efternavn";
            $scope.email = "E-mail";
            $scope.password = "Adgangskode";
            $scope.countrycodes = "Landekode";
            $scope.mobile = "Mobil nummer";
            $scope.cancel = "Annuller";
            $scope.next = "Næste";
            $scope.ccodes = "landekode";
        }


        $scope.user = {};
        $scope.model2 = {};

        $scope.model2.Design = "Consumer";
        $scope.statename = 0;


        //var langid = $scope.lang;
        //debugger;
        //loginService.getcountryname(langid).then(function (result) {

        //    if (result.data.status = true) {
        //        $scope.getcountry = result.data.CountryCodeList;
        //        console.log(result);

        //        $scope.allcountry = $scope.getcountry[0];
        //        debugger;
        //    }
        //});



        //changeby suman date=""20-05-2017
        /* var ipObj1 = {
             callback: function (val) {  //Mandatory
    
                 var dob = new Date(val);
                 $scope.user.dob = dob.toDateString();
                 $scope.getuserdetails.DOB = $scope.getBirthYearStr();
    
             },
             disabledDates: [            //Optional
               new Date(2016, 2, 16),
               new Date(2015, 3, 16),
               new Date(2015, 4, 16),
               new Date(2015, 5, 16),
               new Date('Wednesday, August 12, 2015'),
               new Date("08-16-2016"),
               new Date(1439676000000)
             ],
             from: new Date(1960, 1, 1), //Optional
             to: new Date(), //Optional
             inputDate: new Date(),      //Optional
             mondayFirst: true,          //Optional
             disableWeekdays: [0],       //Optional
             closeOnSelect: false,       //Optional
             templateType: 'popup'       //Optional
             
         };*/


        $scope.cancellreg = function () {
            $state.go('app.home');
        }
        var onFailureCallback = function () {
        };




        $scope.blurempty = function (e) {

            if (e.target.value == "") {

                HelperService.showFailurePopup(true, onFailureCallback, $scope, "Please enter " + $(e.target).closest('tr').children('td').first().text());
            }
        }



        $scope.openDatePicker = function () {
            ionicDatePicker.openDatePicker(ipObj1);
        };

        //comment by suman
        //  $scope.blurempty = function (e) {

        //   if (e.target.value == "") {

        //      HelperService.showFailurePopup(true, onFailureCallback, $scope, "Please enter " + $(e.target).closest('tr').children('td').first().text());
        // }
        //  }

        //by date 22-03-2017

        loginService.getprofile().then(function (responcedata) {
            //debugger;
            $scope.getuserdetails = responcedata.data.model;

            console.log(responcedata);
            /* console.log($scope.getuserdetails.Gender);
             if ($scope.getuserdetails.Gender == 'Male') {
                 $scope.getuserdetails.Gender = 'm';
             } else {
                 $scope.getuserdetails.Gender = 'f';
             }
             console.log($scope.getuserdetails.Gender);
             var MyDate_String_Value = responcedata.data.model.DOB;
            
             var value = new Date
             (
                  parseInt(MyDate_String_Value.replace(/(^.*\()|([+-].*$)/g, ''))
             ); value.getMonth() +
                          1 +
                        "/" +
            value.getDate() +
                        "/" +
        value.getFullYear();
    
           //  var curtdob = new Date(value);
             // debugger;
          //   $scope.user.dob = curtdob.toDateString();
    
          //   $scope.getBirthYearStr = function () {
                
             //    return HelperService.getMonthText($scope.user.dob) + "/" + HelperService.getDayText($scope.user.dob) + "/" + HelperService.getYearText($scope.user.dob);
           //  }
             //$scope.model2.DOB = $scope.getBirthYearStr();
    
            // $scope.getuserdetails.DOB = $scope.getBirthYearStr(); */

            $ionicLoading.hide();
        });

        $scope.regstration = function () {
            //debugger;
            // $scope.getuserdetails.DOB = $scope.userDOB;

            //console.log($scope.userDOB);

            loginService.updateprofile($scope.getuserdetails).then(function (responcedata) {

                // $scope.showlines($ionicLoading);

                //   console.log(responcedata.data.data.UserProfileID);

                // $ionicLoading.hide();
                // $scope.addres = responcedata.data.data;
                //  $state.go('app.optional'); 

                $state.go('app.optional', { object: JSON.stringify({ opt: 'update', UserProfileID: responcedata.data.data.UserProfileID }) });
                // HelperService.showFailurePopup(responcedata, onFailureCallback, $scope, responcedata.data.data.Success);
                //
            }, function () {
                HelperService.showFailurePopup(errmsg, onFailureCallback, $scope, "Registration failed");
                //$ionicLoading.hide();
            });


        }
    }).controller('communityctrl', function ($scope, loginService, $rootScope, $ionicPopup, $ionicLoading, $state, $ionicActionSheet, $timeout) {


        $scope.lang = $rootScope.lang;
        

        if ($scope.lang == "") {
            $scope.startnew = "Start New Discussion";
            $scope.Most_Recent = "Most Recent";
            $scope.Topics = "Topics";
            $scope.del = "Delete";
            $scope.edi = "Edit";
            $scope.Send = "Send";
            $scope.cancel = "Cancel";
            $scope.update = "Update";
            $scope.newdiscussion = "New Discussion";
            $scope.title = "Title";
            $scope.Description = "Description";
        }

        if ($scope.lang == 1) {
            $scope.startnew = "Start New Discussion";
            $scope.Most_Recent = "Most Recent";
            $scope.Topics = "Topics";
            $scope.del = "Delete";
            $scope.edi = "Edit";
            $scope.Send = "Send";
            $scope.cancel = "Cancel";
            $scope.update = "Update";
            $scope.newdiscussion = "New Discussion";
            $scope.title = "Title";
            $scope.Description = "Description";
        } else if ($scope.lang == 2) {

            $scope.startnew = "Start ny diskussion";
            $scope.Most_Recent = "Seneste";
            $scope.Topics = "Emner";
            $scope.del = "Slet";
            $scope.edi = "Rediger";
            $scope.Send = "Sende";
            $scope.cancel = "Afbestille";
            $scope.update = "opdatering";
            $scope.newdiscussion = "Ny diskussion";
            $scope.title = "Titel";
            $scope.Description = "Beskrivelse";
        }








        $scope.timeconver = function (dates) {
            var pattern = /Date\(([^)]+)\)/;
            var results = pattern.exec(dates);
            var dt = new Date(parseFloat(results[1]));
            return dt;
        }


        $state.compids = JSON.parse($state.params.object);
        $scope.showlines($ionicLoading);
        $scope.blogsDat = [];
        loginService.GetCommunity($state.compids.companyprofileid,$scope.lang).then(function (result) {
            // debugger;

            $scope.comdetails = result.data.Comp;
            $scope.sortby = "";
            $scope.blogsDat = result.data.Comp.blogsData;




            console.log(result);
            $ionicLoading.hide();

        });
        $scope.data = [];
        $scope.parentthread = [];
        $scope.data.description = "";
        // $scope.blogsDat[0].UserName = "";
        $scope.blogdescription = [];
        $scope.commentdescription = [];
        $scope.data.texttitile = "";
        //  $scope.blogsDat[0].UserName = '';
        $scope.poppup = function () {
            if($scope.lang == "" || $scope.lang ==1){
            var myPopup = $ionicPopup.show({
                template: ' <div class="pop2"><div class="fon-ico"><span class="akj"  id="fonc">+</span></div><div class="ref-fri"><p ng-if="lang !=2 || lang == 1" >New Discussion</p><p ng-if="lang==2">Ny diskussion</p></div><div class="tit"><h3 ng-if="lang != 2 && lang ==1">Title</h3><h3 ng-if="lang == 2">Titel</h3><input type="text" ng-model="data.texttitile" /></div><div class="tex"><h3 ng-if="lang !=2 && lang == 1">Description</h3><h3 ng-if="lang ==2">Beskrivelse</h3><textarea rows="5" cols="45"  ng-model="data.description"></textarea></div><div class="sabtn"></div></div></div>',
                 

                scope: $scope,
                buttons: [
                  { text: 'Cancel' },
                  {
                      text: '<b>Save</b>',
                      type: 'button-positive',
                      onTap: function (e) {
                          if (!$scope.data.description) {
                              //don't allow the user to close unless he enters wifi password
                              e.preventDefault();
                          } else {

                              loginService.PostReview($scope.data.description, $state.compids.companyprofileid, $scope.blogsDat[0].UserName, $scope.data.texttitile).then(function (result) {

                                  // $scope.comdetails = result.data.Comp;

                                  // $scope.blogsDat = result.data.Comp.blogsData;
                                  console.log(result);
                                  $ionicLoading.hide();
                                  $state.reload()

                              });
                              //return $scope.data.wifi;
                          }
                      }
                  }
                ]


            });

        } else {
                var myPopup = $ionicPopup.show({
                    template: ' <div class="pop2"><div class="fon-ico"><span class="akj"  id="fonc">+</span></div><div class="ref-fri"><p ng-if="lang !=2 || lang == 1" >New Discussion</p><p ng-if="lang==2">Ny diskussion</p></div><div class="tit"><h3 ng-if="lang != 2 && lang ==1">Title</h3><h3 ng-if="lang == 2">Titel</h3><input type="text" ng-model="data.texttitile" /></div><div class="tex"><h3 ng-if="lang !=2 && lang == 1">Description</h3><h3 ng-if="lang ==2">Beskrivelse</h3><textarea rows="5" cols="45"  ng-model="data.description"></textarea></div><div class="sabtn"></div></div></div>',


                    scope: $scope,
                    buttons: [
                      { text: 'Afbestille' },
                      {
                          text: '<b>Gemme</b>',
                          type: 'button-positive',
                          onTap: function (e) {
                              if (!$scope.data.description) {
                                  //don't allow the user to close unless he enters wifi password
                                  e.preventDefault();
                              } else {

                                  loginService.PostReview($scope.data.description, $state.compids.companyprofileid, $scope.blogsDat[0].UserName, $scope.data.texttitile).then(function (result) {

                                      // $scope.comdetails = result.data.Comp;

                                      // $scope.blogsDat = result.data.Comp.blogsData;
                                      console.log(result);
                                      $ionicLoading.hide();
                                      $state.reload()

                                  });
                                  //return $scope.data.wifi;
                              }
                          }
                      }
                    ]


                });


        }
        }



        $scope.name = {};

        $scope.sortings = function (name) {
            
            $("#radiobuttons").hide();
            $scope.comdetails.ProductID;

            loginService.getcommunitybysorting($scope.comdetails.ProductID, name, $scope.lang).then(function (result) {
                // debugger;
                $scope.comdetails = result.data.Comp;

                $scope.blogsDat = result.data.Comp.blogsData;
                $scope.sortby = "1";
                if($scope.lang == "" || $scope.lang == 1){
                if (name == "Most Recent") {
                    $scope.sortbys = "Most Recent";
                } else if (name == "Oldest First") {
                    $scope.sortbys = "Oldest First";
                } else if (name == "Popular") {
                    $scope.sortbys = "Popular";
                }
                }

                if ($scope.lang == 2) {
             if (name == "Most Recent") {
                 $scope.sortbys = 'Seneste';
             } else if (name == "Oldest First") {
               
                 $scope.sortbys = 2;
             } else if (name == "Popular") {
                 $scope.sortbys = 3;
             }
        }
                console.log(result);

            });


        }

        /*   $scope.sortby = function () {
               var sortby = $ionicPopup.show({
                   template: '<ion-radio  ng-model="choice" (click)="selected(mostrecent)" [checked]="mostrecent" ng-value="mostrecent" ng-checked="true">Most Recent</ion-radio><ion-radio  ng-model="choice" ng-value="2">Oldest First</ion-radio><ion-radio  ng-model="choice" ng-value="3">Popular</ion-radio>',
                   
                   scope: $scope,
                   
                  });
               $timeout(function () {
                  sortby.close(); 
              }, 6000);
           } */

        $scope.PostReview = function () {
            //  alert(ids);
            // console.log($scope.description);
            loginService.PostReview($scope.description, $state.compids.companyprofileid, $scope.blogsDat[0].UserName, $scope.texttitile).then(function (result) {
                $ionicLoading.hide();
                // $scope.comdetails = result.data.Comp;

                // $scope.blogsDat = result.data.Comp.blogsData;
                console.log(result);
                var obj = { companyprofileid: $state.compids.companyprofileid, catgorey: 0 }
                $state.go('app.community', { object: JSON.stringify(obj) });
                $state.reload()

            });
        }

        $scope.blogpost = function (ids) {
            // alert(ids);
            // console.log($scope.blogdescription[ids]);
            loginService.blogpost($scope.blogsDat[ids].BlogID, $scope.blogdescription[ids], '').then(function (result) {
                // debugger;
                // $scope.comdetails = result.data.Comp;

                // $scope.blogsDat = result.data.Comp.blogsData;
                console.log(result);
                $ionicLoading.hide();
                var obj = { companyprofileid: $state.compids.companyprofileid, catgorey: 0 }
                $state.go('app.community', { object: JSON.stringify(obj) });
                $state.reload()

            });
        }
        $scope.Comment = {};

        $scope.editcomment = function (parentid, Comment) {
            // debugger;

            loginService.editcomment(parentid, Comment).then(function (result) {
                //  debugger;
                $state.go('app.community', { status: true, dat: true });
                $state.reload()
            });

        }



        $scope.showConfirm = function (id) {
            var confirmPopup = $ionicPopup.confirm({
                title: 'Warning!',
                template: 'Are you sure you want to delete?'
            });
            confirmPopup.then(function (res) {
                if (res) {
                    loginService.deletescomment(id).then(function (result) {
                        // debugger;

                        console.log(result);

                        $state.go('app.community', { status: true, dat: true });
                        $state.reload()
                    });

                } else {

                }
            });

        };


        $scope.showConfirma = function (id, ed) {
            var confirmPopup = $ionicPopup.confirm({
                //title: 'Consume Ice Cream',
                template: 'Are you sure you want to delete comment?'
            });

            confirmPopup.then(function (res) {
                if (res) {
                    loginService.deletepostcomment(id).then(function (result) {
                        //  debugger;
                        //console.log(result);
                        $state.go('app.community', { status: true, dat: true });
                        $state.reload()
                    });
                }
            });

        }

        $scope.Postcomment = function (parentid, ids) {
            // alert(parentid, ids);
            // debugger;
            loginService.blogpost($scope.blogsDat[parentid].BlogID, $scope.commentdescription[parentid], blogda.ListofComments[parentid].BlogThreadID).then(function (result) {
                debugger;
                // $scope.comdetails = result.data.Comp;

                // $scope.blogsDat = result.data.Comp.blogsData;
                console.log(result);
                $ionicLoading.hide();
                var obj = { companyprofileid: $state.compids.companyprofileid, catgorey: 0 }
                $state.go('app.community', { object: JSON.stringify(obj) });
                $state.reload()

            });

        }
    }).controller('myreviewsctrl', function ($scope, loginService, $rootScope, $ionicLoading, $ionicPopup, ionicDatePicker, $state, $ionicActionSheet, $cordovaSocialSharing) {

        $scope.lang = window.localStorage.getItem("langKey1");

        if ($scope.lang == "") {
            $scope.Reviews = "Reviews";
            $scope.details = "Details";
            $scope.Share = "Share";
            $scope.Edit = "Edit";
            $scope.Delete = "Delete";
        }

        if ($scope.lang == 1) {
            $scope.Reviews = "Reviews";
            $scope.details = "Details";
            $scope.Share = "Share";
            $scope.Edit = "Report";
            $scope.Delete = "Delete";

        } else if ($scope.lang == 2) {

            $scope.Reviews = "Anmeldelser";
            $scope.details = "Detaljer";
            $scope.Share = "Del";
            $scope.Edit = "Rediger";
            $scope.Delete = "Slet";

        }



        $scope.showlines($ionicLoading);
        $scope.ratingclass = function () {

            setTimeout(function () {
                $('.barra-nivel').each(function () {
                    var valorLargura2 = $(this).data('nivel');

                    var valorLargura = $(this).attr('data-nivel').replace("%", '');
                    //  alert(valorLargura);
                    // console.log(valorLargura);
                    // var bindpers = parseInt(valorLargura.replace("%", ''));
                    var bindpers = parseInt(valorLargura);
                    var valorNivel = $(this).parent().parent().next().html("<span class='valor-nivel'>" + (bindpers / 10) + "</span>");

                    // var valorNivel = $(this).parent().parent().next().html("<span class='valor-nivel'>" + valorLargura + "</span>");
                    $(this).animate({
                        width: valorLargura2
                    });
                });

                $('.barra-nivel').each(function () {
                    //debugger;
                    var x = $(this).attr('data-nivel').split('%');

                    if (x[0] <= 60) {
                        $(this).css('background', '#fb4803');
                        $(this).parent().parent().next().css('background', '#fb4803');
                    }
                    else if (x[0] > 60 && x[0] <= 80) {
                        $(this).css('background', '#f89b0f');
                        $(this).parent().parent().next().css('background', '#f89b0f');
                    }
                    else if (x[0] > 80) {
                        $(this).css('background', '#2fc12f');
                        $(this).parent().parent().next().css('background', '#2fc12f');
                    }
                });

                function collision($div1, $div2) {
                    var x1 = $div1.offset().left;
                    var w1 = 40;
                    var r1 = x1 + w1;
                    var x2 = $div2.offset().left;
                    var w2 = 40;
                    var r2 = x2 + w2;

                    if (r1 < x2 || x1 > r2) return false;
                    return true;

                }

                // // slider call

                $('#slider').slider({
                    range: true,
                    min: 0,
                    max: 10,
                    values: [0, 4],
                    slide: function (event, ui) {
                        //debugger;
                        $('.ui-slider-handle:eq(0) .price-range-min').html('$' + ui.values[0]);
                        $('.ui-slider-handle:eq(1) .price-range-max').html('$' + ui.values[1]);
                        $('.price-range-both').html('<i>$' + ui.values[0] + ' - </i>$' + ui.values[1]);

                        //

                        if (ui.values[0] == ui.values[1]) {
                            $('.price-range-both i').css('display', 'none');
                        } else {
                            $('.price-range-both i').css('display', 'inline');
                        }

                        //

                        if (collision($('.price-range-min'), $('.price-range-max')) == true) {
                            $('.price-range-min, .price-range-max').css('opacity', '0');
                            $('.price-range-both').css('display', 'block');
                        } else {
                            $('.price-range-min, .price-range-max').css('opacity', '1');
                            $('.price-range-both').css('display', 'none');
                        }

                    }
                });

                $('.ui-slider-range').append('<span class="price-range-both value"><i>$' + $('#slider').slider('values', 0) + ' - </i>' + $('#slider').slider('values', 1) + '</span>');

                $('.ui-slider-handle:eq(0)').append('<span class="price-range-min value">$' + $('#slider').slider('values', 0) + '</span>');

                $('.ui-slider-handle:eq(1)').append('<span class="price-range-max value">$' + $('#slider').slider('values', 1) + '</span>');
                timeinter = 0;

            }, 3);
        }

        loginService.GetReviews().then(function (result) {
            $ionicLoading.hide();
            console.log(result);
            // $scope.userdetails = result.data.result;

            $scope.companydata = result.data.obj1;
            console.log($scope.companydata);
            $scope.ratingclass();

        });

        $scope.blurfunction = function (e) {
            if (!$scope.emailFormat.test(e.target.value)) {
                // // console.log($event.target.value);
                HelperService.showFailurePopup(true, onFailureCallback, $scope, "Please enter valid emailid");
            }
        }


        $scope.ratingval = "";
        $scope.surveyid = "";
        $scope.israting = true;
        $scope.editratings = function (id, rating) {
            // debugger;
            //   alert(rating);
            $scope.ratingval = id;
            loginService.surveyquestionsupdate(id, true).then(function (result) {
                debugger;
                console.log(result.data);
                $ionicLoading.hide();

                $scope.questions = result.data.obj.SurveyQuestions;
                $scope.surveyid = result.data.obj.SurveyId;
                $scope.ratingclass();
                $scope.$watch('ratingval', function () {
                    // do something here
                    // $scope.ratingval = id;
                    $scope.questions;

                }, true);
            });
            var idrating = "Survey_surveyop_" + rating;
            var ratclashh = true;
            if (ratclashh == true)
                setTimeout(function () {
                    $scope.RatingChange(idrating, rating);
                    ratclashh == false;
                }, 1000);
        }
        $scope.editcomment = function (id, rating) {
            //   alert(rating);

            $scope.ratingval = id;
            loginService.surveyquestionsupdate(id, false).then(function (result) {
                debugger;
                console.log(result.data);
                $ionicLoading.hide();

                $scope.questions = result.data.obj.SurveyQuestions;
                $scope.surveyid = result.data.obj.SurveyId;
                $scope.response = result.data.response;
                $scope.responsetitle = result.data.responsetitle;
                $scope.ratingclass();
                $scope.$watch('ratingval', function () {
                    // do something here
                    // $scope.ratingval = id;
                    $scope.questions;

                }, true);
            });
            var idrating = "Survey_surveyop_" + rating;


            setTimeout(function () {
                $scope.RatingChange(idrating, rating);
            }, 1000);
        }
        $scope.RatingChange = function (id, option) {
            //debugger;
            $rootScope.surrespon = option;
            $("#SurveyQuesID_2").val(option);
            $(".rt").find("span").removeClass("act");
            $("#" + id).addClass("act");
            for (var i = 0; i < $(".rt").find("span").length; i++) {
                if ($(".rt").find("span")[i].id == id) {
                    return;
                }
                $(".rt").find("span").eq(i).addClass("act");
            }


        }




        $scope.cancellreg = function () {
            // debugger;
            if ($scope.israting == true && $scope.surveyid != '') {

                $scope.editcomment($scope.surveyid);

            } else {
                $state.go('app.home');
            }
        }


        $scope.reportasspam = "";
        $scope.showdialog = function (id) {

            var myPopup = $ionicPopup.show({
                template: '<div class="pop2"><div style="background-color: #eee;padding: 13px;"><h5 style="margin: 0;">Notify Buzz Bee</h5></div><div class="fon-ico"></div><div class="text" style="padding: 10px;"><h5 style="font-weight: normal;color: #666;">Dear,</br></br>You have just chosen to notify Buzz Bee because you think that this review violates Buzz Bees guidelines or rules.</br></br>Please provide as much information as possible in the text box below(min.75 characters.)</h5><textarea rows="5" cols="45"  ng-model="reportasspam" maxlength="75" style="border:1px solid #ddd;"></textarea></div><div class="sabtn"></div></div></div>',

                scope: $scope,
                buttons: [
                  { text: 'Cancel' },
                  {
                      text: '<b>Save</b>',
                      type: 'button-positive',
                      onTap: function (e) {

                          if (!$scope.reportasspam) {

                              //don't allow the user to close unless he enters wifi password
                              //  e.preventDefault();
                              return $scope.reportspam();
                          } else {
                              //debugger;
                              // console.log($scope.reportasspam);
                              loginService.reportspam($scope.id, $scope.comdetails.SurveyRespID, $scope.reportasspam).then(function (result) {

                                  console.log(result);
                                  $ionicLoading.hide();

                              });
                              //return $scope.data.wifi;
                          }
                      }
                  }
                ]
            });
        }


        $scope.submit = function () {
            $scope.questions
            for (var i = 0; i < $scope.questions.length; i++) {




                if ($scope.questions[i].SurveyQuesType == "Rating") {
                    $scope.SurveyQuesID = $scope.questions[i].SurveyQuesID;
                    $scope.SurveyQuesType = $scope.questions[i].SurveyQuesType;

                    $scope.SurveyResp = $rootScope.surrespon;
                    console.log($rootScope.surrespon);
                    $scope.SurveyQuesTypeID = $scope.questions[i].SurveyQuesTypeID;
                    //$scope.SurveyResp=$scope.SurveyResp1;
                    $scope.SurveyRespTitle = "";
                }
                else {
                    $scope.israting = false;
                    $scope.SurveyQuesID = $scope.questions[i].SurveyQuesID;
                    $scope.SurveyQuesType = $scope.questions[i].SurveyQuesType;
                    $scope.SurveyQuesTypeID = $scope.questions[i].SurveyQuesTypeID;
                    $scope.SurveyRespTitle = $scope.questions[i].SurveyRespTitle;
                    $scope.SurveyResp = $scope.questions[i].SurveyResp;
                }




            };


            loginService.surveyResponse($scope.SurveyQuesID, $scope.SurveyQuesType, $scope.SurveyResp, $scope.surveyid, $scope.SurveyQuesTypeID, $scope.SurveyRespTitle).then(function (resdata) {
                console.log(resdata);
                //$scope.res = data;
                if ($scope.SurveyQuesType == 'Rating') {
                    $scope.editcomment($scope.surveyid);
                    // $state.go($state.current,{ reload: true, inherit: false });
                } else {
                    $state.go('app.home');
                }
                // $state.go('app.survyResponses', { object: $scope.SurRespID });
                //  console.log($scope.res);
            });
            console.log($scope.SurveyQuesID);

            //console.log($scope.questions);

        };


        $scope.showConfirm = function (id) {
            var confirmPopup = $ionicPopup.confirm({
                //title: 'Consume Ice Cream',
                template: 'Are you sure you want to delete?'
            });
            confirmPopup.then(function (res) {
                if (res) {
                    loginService.DeleteReview(id).then(function (result) {
                        $ionicLoading.hide();
                        console.log(result);

                        $state.go($state.current, { reload: true, inherit: false });
                    });

                } else {

                }
            });
        };
        $scope.OtherShare = function (msg) {
            //window.plugins.socialsharing.share('Digital Signature Maker', 'test', null, 'https://play.google.com/store/apps/details?id=com.prantikv.digitalsignaturemaker');
            //alert($scope.userlist[msg].UserReview);
            // $scope.userlist[msg].UserReview;
            $cordovaSocialSharing.share($scope.companydata[msg].CompanyDesc, 'myreviews', null, $scope.companydata[msg].Company_Url);
            // $cordovaSocialSharing.share({ "message": "This is your message" }, { "subject": "This is your subject" }, { "fileuplaod": null }, { "url": "http://blog.nraboy.com" });
            //$cordovaSocialSharing.shareViaFacebook($scope.userlist[msg].UserReview, null, "https://www.thepolyglotdeveloper.com");
        }

        $scope.timeconver = function (dates) {
            var pattern = /Date\(([^)]+)\)/;
            var results = pattern.exec(dates);
            var dt = new Date(parseFloat(results[1]));
            return dt;

            var MyDate_String_Value = dates;

            var value = new Date
            (
                 parseInt(MyDate_String_Value.replace(/(^.*\()|([+-].*$)/g, ''))
            );
            var datetime = value.getMonth() +
                         1 +
                       "/" +
           value.getDate() +
                       "/" +
       value.getFullYear();

            var curtdob = new Date(value);
            // debugger;
            curtdob = curtdob.toDateString();
            //return curtdob;
            var dateOut = new Date(dates);
            dateOut.setDate(dateOut.getDate() + 1);
            //debugger;
            return dateOut;




        }
    }).controller('myCommunitiesctrl', function ($scope, loginService, $rootScope, $ionicLoading, ionicDatePicker, $state, $ionicActionSheet, $cordovaSocialSharing) {

        $scope.lang = window.localStorage.getItem("langKey1");

        if ($scope.lang == "") {
            $scope.Reviews = "Reviews";
            $scope.details = "Details";
            $scope.Share = "Share";
            $scope.Edit = "Edit";
            $scope.Delete = "Delete";
        }

        if ($scope.lang == 1) {
            $scope.Reviews = "Reviews";
            $scope.details = "Details";
            $scope.Share = "Share";
            $scope.Edit = "Report";
            $scope.Delete = "Delete";

        } else if ($scope.lang == 2) {

            $scope.Reviews = "Anmeldelser";
            $scope.details = "Detaljer";
            $scope.Share = "Del";
            $scope.Edit = "Redigere";
            $scope.Delete = "Slet";

        }


        $scope.mycommunity = [];
        $scope.showlines($ionicLoading);
        loginService.GetmyCommunities().then(function (result) {
            // debugger;

            $ionicLoading.hide();
            //console.log(result);
            $scope.mycommunity = result.data.result;
        });

        $scope.Community = function (id) {
            // alert(id);
            // $rootScope.loginreview = val;
            var obj = { companyprofileid: id, catgorey: 0 }
            $state.go('app.community', { object: JSON.stringify(obj) });
            // $state.go('app.community');
        }

        $scope.timeconver = function (dates) {


            var MyDate_String_Value = dates;

            var value = new Date
            (
                 parseInt(MyDate_String_Value.replace(/(^.*\()|([+-].*$)/g, ''))
            );
            var datetime = value.getMonth() +
                         1 +
                       "/" +
           value.getDate() +
                       "/" +
       value.getFullYear();

            var curtdob = new Date(value);
            // debugger;
            curtdob = curtdob.toDateString();
            return curtdob;
        }
    })
.controller('helpCtrl', function ($ionicLoading, $ionicPopup, $scope, $rootScope, $state, loginService, HelperService) {
    $scope.lang = $rootScope.lang;


})
.controller('forgotpasswordCtrl', function ($ionicLoading, $ionicPopup, $scope, $rootScope, $state, loginService, HelperService) {

    $scope.cancellforgot = function () {
        $state.go('app.login');
    }
    var onFailureCallback = function () {
    };
    $scope.emailFormat = /^[a-z]+[a-z0-9._]+@[a-z]+\.[a-z.]{2,5}$/;
    //  ng-pattern="emailFormat" 
    $scope.blurfunction = function (e) {
        if (!$scope.emailFormat.test(e.target.value)) {
            // // console.log($event.target.value);
            HelperService.showFailurePopup(true, onFailureCallback, $scope, "Please enter valid emailid");
        }
    }


    $scope.forgotpasswordPh = "Email";
    $scope.cancel = "CANCEL";
    $scope.submit = "SUBMIT";

    $scope.lang = window.localStorage.getItem("langKey");
    console.log($scope.lang);
    if ($scope.lang == 1) {
        debugger;
        $scope.forgotpasswordPh = "Email";
        $scope.cancel = "CANCEL";
        $scope.submit = "SUBMIT";
    } else {
        debugger;
        $scope.forgotpasswordPh = "Email";
        $scope.cancel = "SEND";
        $scope.submit = "ANNULLER";
    }





    $scope.user = {};
    $scope.forgotpassword = function () {
        $scope.showdots($ionicLoading);
        loginService.forgotpassword($scope.user).then(function (responcedata) {
            // debugger;
            $ionicLoading.hide();
            var alertPopup = $ionicPopup.alert({
                title: 'forgot password!',
                template: 'Please check your valid mail'
            });
            alertPopup.then(function (responcedata) {
                console.log('please check your valid mail');
            });
            //console.log(responcedata);
            $state.go('app.login');

        }, function (errmsg) {
            HelperService.showFailurePopup(errmsg, onFailureCallback, $scope, errmsg);
            // $ionicLoading.hide();
        });
    }

});