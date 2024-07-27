var t;

(function(undefined) {
    var scannerLaser = $(".scanner-laser"),
        imageUrl = $("#image-url"),
        decodeLocal = $("#decode-img"),
        play = $("#play"),
        scannedImg = $("#scanned-img"),
        scannedQR = $("#scanned-QR"),
        grabImg = $("#grab-img"),
        pause = $("#pause"),
        stop = $("#stop"),
        contrast = $("#contrast"),
        contrastValue = $("#contrast-value"),
        zoom = $("#zoom"),
        zoomValue = $("#zoom-value"),
        brightness = $("#brightness"),
        brightnessValue = $("#brightness-value"),
        threshold = $("#threshold"),
        thresholdValue = $("#threshold-value"),
        sharpness = $("#sharpness"),
        sharpnessValue = $("#sharpness-value"),
        grayscale = $("#grayscale"),
        grayscaleValue = $("#grayscale-value"),
        flipVertical = $("#flipVertical"),
        flipVerticalValue = $("#flipVertical-value"),
        flipHorizontal = $("#flipHorizontal"),
        flipHorizontalValue = $("#flipHorizontal-value");
    var args = {
        autoBrightnessValue: 100,
        resultFunction: function(res) {
            scannedImg.attr("src", res.imgData);
            $.ajax({
                type: 'POST',
                url: "intranet/controllers/form_id.php?op=saveupdate",
                data: {'identificacion':res.code},
                success: function(results){
                    if (results==1) { 
                    Swal.fire({type:'success',title:'Exito',text:'Entrada registrada correctamente',showConfirmButton: false,timer: 1500})
                    var audio=document.getElementById("entrada");
                    audio.play();  
                }else if(results==2){
                    Swal.fire({type:'error',title:'Error',text:'Entrada no registrada',showConfirmButton: false,timer: 1500})
                    var audio=document.getElementById("error");
                    audio.play();  

                }else if(results==3){
                    swal.fire({type:'error',title:'Adventencia!',text:'Entrada ya Resgidrada, Espere un momento',showConfirmButton: false,timer: 1600}); 
                    var audio=document.getElementById("yamarco");
                    audio.play(); 
                }else if(results==4){
                    Swal.fire({type:'success',title:'Exito',text:'Salida registrada correctamente',showConfirmButton: false,timer: 1500})
                    var audio=document.getElementById("salida");
                    audio.play(); 
                }else if(results==5){
                    Swal.fire({type:'error',title:'Error',text:'Salida no registrada',showConfirmButton: false,timer: 1500})
                    var audio=document.getElementById("error");
                    audio.play(); 
                }else if(results==6){
                    Swal.fire({type:'error',title:'Error',text:'Codigo Desonocido',showConfirmButton: false,timer: 1500})
                    var audio=document.getElementById("desconocido");
                    audio.play();  
                } else if (datos == 7) {
                    Swal.fire({ type: 'error', title: 'Error', text: 'El alumno ya fue registrado con justificacion', showConfirmButton: false, timer: 2000 })
                     var audio=document.getElementById("justificacion");
                     audio.play();  
                } else if (datos == 8) {
                    Swal.fire({ type: 'error', title: 'Error', text: 'El alumno ya fue registrado con falta', showConfirmButton: false, timer: 1500 })
                    var audio=document.getElementById("falta");
                     audio.play();  
                } else if (datos == 9) {
                    Swal.fire({ type: 'success', title: 'Exito', text: 'Entrada registrada correctamente', showConfirmButton: false, timer: 1500 })
                } else {
                    Swal.fire({ type: 'error', title: 'Error', text: 'Digite codigo de Identificación', showConfirmButton: false, timer: 1500 })
                    var audio = document.getElementById("idden");
                    audio.play();

                }
                    t.ajax.reload();                                               
                }
            });

            [].forEach.call(scannerLaser, function(el) {
                $(el).fadeOut(300, function() {
                    $(el).fadeIn(300);
                });
            });
            
            // scannedQR.text(res.format + ": " + res.code);
        },
        getDevicesError: function(error) {
            var p, message = "Error detectado con los siguientes parámetros.:\n";
            for (p in error) {
                message += (p + ": " + error[p] + "\n");
            }
            alert(message);
        },
        getUserMediaError: function(error) {
            var p, message = "Error detectado con los siguientes parámetros.:\n";
            for (p in error) {
                message += (p + ": " + error[p] + "\n");
            }
            alert(message);
        },
        cameraError: function(error) {
            var p, message = "Error detectado con los siguientes parámetros.:\n";
            if (error.name == "NotSupportedError") {
                var ans = confirm("Su navegador no soporta getUserMedia a través de HTTP!\n(see: https://goo.gl/Y0ZkNV).\n Quieres ver la página de demostración de github en una nueva ventana.?");
                if (ans) {
                    window.open("https://andrastoth.github.io/webcodecamjs/");
                }
            } else {
                for (p in error) {
                    message += p + ": " + error[p] + "\n";
                }
                alert(message);
            }
        },
        cameraSuccess: function() {
            grabImg.removeClass("disabled");
        }
    };
    var decoder = $("#webcodecam-canvas").WebCodeCamJQuery(args).data().plugin_WebCodeCamJQuery.play();
    decoder.buildSelectMenu("#camera-select", "environment|back").init();
    decodeLocal.on("click", function() {
        Page.decodeLocalImage();
    });
    play.on("click", function() {
        scannedQR.text("Scanning ...");
        grabImg.removeClass("disabled");
        decoder.play();
    });
    grabImg.on("click", function() {
        scannedImg.attr("src", decoder.getLastImageSrc());
    });
    pause.on("click", function(event) {
        scannedQR.text("Paused");
        decoder.pause();
    });
    stop.on("click", function(event) {
        grabImg.addClass("disabled");
        scannedQR.text("Stopped");
        decoder.stop();
    });
    Page.changeZoom = function(a) {
        if (decoder.isInitialized()) {
            var value = typeof a !== "undefined" ? parseFloat(a.toPrecision(2)) : zoom.val() / 10;
            zoomValue.text(zoomValue.text().split(":")[0] + ": " + value.toString());
            decoder.options.zoom = value;
            if (typeof a != "undefined") {
                zoom.val(a * 10);
            }
        }
    };
    Page.changeContrast = function() {
        if (decoder.isInitialized()) {
            var value = contrast.val();
            contrastValue.text(contrastValue.text().split(":")[0] + ": " + value.toString());
            decoder.options.contrast = parseFloat(value);
        }
    };
    Page.changeBrightness = function() {
        if (decoder.isInitialized()) {
            var value = brightness.val();
            brightnessValue.text(brightnessValue.text().split(":")[0] + ": " + value.toString());
            decoder.options.brightness = parseFloat(value);
        }
    };
    Page.changeThreshold = function() {
        if (decoder.isInitialized()) {
            var value = threshold.val();
            thresholdValue.text(thresholdValue.text().split(":")[0] + ": " + value.toString());
            decoder.options.threshold = parseFloat(value);
        }
    };
    Page.changeSharpness = function() {
        if (decoder.isInitialized()) {
            var value = sharpness.prop("checked");
            if (value) {
                sharpnessValue.text(sharpnessValue.text().split(":")[0] + ": on");
                decoder.options.sharpness = [0, -1, 0, -1, 5, -1, 0, -1, 0];
            } else {
                sharpnessValue.text(sharpnessValue.text().split(":")[0] + ": off");
                decoder.options.sharpness = [];
            }
        }
    };
    Page.changeGrayscale = function() {
        if (decoder.isInitialized()) {
            var value = grayscale.prop("checked");
            if (value) {
                grayscaleValue.text(grayscaleValue.text().split(":")[0] + ": on");
                decoder.options.grayScale = true;
            } else {
                grayscaleValue.text(grayscaleValue.text().split(":")[0] + ": off");
                decoder.options.grayScale = false;
            }
        }
    };
    Page.changeVertical = function() {
        if (decoder.isInitialized()) {
            var value = flipVertical.prop("checked");
            if (value) {
                flipVerticalValue.text(flipVerticalValue.text().split(":")[0] + ": on");
                decoder.options.flipVertical = value;
            } else {
                flipVerticalValue.text(flipVerticalValue.text().split(":")[0] + ": off");
                decoder.options.flipVertical = value;
            }
        }
    };
    Page.changeHorizontal = function() {
        if (decoder.isInitialized()) {
            var value = flipHorizontal.prop("checked");
            if (value) {
                flipHorizontalValue.text(flipHorizontalValue.text().split(":")[0] + ": on");
                decoder.options.flipHorizontal = value;
            } else {
                flipHorizontalValue.text(flipHorizontalValue.text().split(":")[0] + ": off");
                decoder.options.flipHorizontal = value;
            }
        }
    };
    Page.decodeLocalImage = function() {
        if (decoder.isInitialized()) {
            decoder.decodeLocalImage(imageUrl.val());
        }
        imageUrl.val(null);
    };
    var getZomm = setInterval(function() {
        var a;
        try {
            a = decoder.getOptimalZoom();
        } catch (e) {
            a = 0;
        }
        if (!!a && a !== 0) {
            Page.changeZoom(a);
            clearInterval(getZomm);
        }
    }, 500);
    $("#camera-select").on("change", function() {
        if (decoder.isInitialized()) {
            decoder.stop().play();
        }
    });
}).call(window.Page = window.Page || {});