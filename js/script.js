$(document).ready(function () {
        //introanimation
        setTimeout(function () {
                $('body').addClass('loaded');
                $('.title-animation').animatedHeadline({
                        animationType: 'rotate-3'
                });
        }, 3000);

        //fullpage plugin
        $('#fullpage').fullpage({
                licenseKey: null,
                anchors: ["home", "profilo", "esperienze", "portfolio", "contatti"],
                recordHistory: false,
                navigation: true,
                navigationPosition: "right",
                showActiveTooltip: true,
                verticalCentered: false
        });

        //canvas ray of lights
        var canvas,
                ctx, //main (visible) canvas/context
                osCanvas,
                osCtx, //offscreen canvas/context
                rect,
                height,
                width,
                objects,
                numParticles,
                numRays, //objects array + totals
                pInput,
                rInput,
                rCount,
                pCount,
                title; //DOM elements
        var Ray = function () {
                this.ctx = osCtx; //locally cache offscreen 2d context for more effecient animation

                this.angle = 85 * Math.PI / 180; //105 deg in radians

                this.init = function () {
                        this.velocity = 0.25 - Math.random() * 0.5; //velocity of x-axis
                        this.len = canvas.height / 2 + Math.random() * (canvas.height / 2); //length of ray between half and full window height
                        this.start = {
                                //start/top of ray
                                x: Math.random() * (canvas.width + 100) - 50,
                                y: 0
                        };
                        this.end = {
                                //end/bottom of ray
                                x: this.start.x + this.len * Math.cos(this.angle), //use sine and cosine to calculate end point based on start point, length and angle
                                y: this.start.y + this.len * Math.sin(this.angle) //start at point, add length then 'rotate' to final point by multiplying sine/cosine of angle
                        };
                        this.ttl = 100 + Math.random() * 200; //total lifespan of ray 'time to live'
                        this.life = 0; //current lifespan of ray
                        this.width = 0.1 + Math.random() * 1; //random width between 0.5 an 4.5
                        this.hue = Math.round(45 + Math.random() * 15).toString(); //random yellow hue between 45 and 60 (degrees)
                        this.saturation = Math.round(20 + Math.random() * 40).toString(); //random saturation between 40% and 60%
                };

                this.color = function () {
                        //generate gradient
                        var alpha = wave(this.life, this.ttl) * 0.005, //fade in/fade out alpha
                                color1 = "hsla(" + this.hue + "," + this.saturation + "%," + "80%," + alpha.toString() + ")", //start color of ray gradient
                                color2 = "hsla(50,20%,60%,0)", //bottom color of ray gradient (transparent)
                                gradient = ctx.createLinearGradient(this.start.x, this.start.y, this.end.x, this.end.y);

                        gradient.addColorStop(0, color1);
                        gradient.addColorStop(1, color2);

                        return gradient;
                };

                this.draw = function () {
                        //draw the ray
                        this.ctx.beginPath();
                        this.ctx.strokeStyle = this.color();
                        this.ctx.lineWidth = this.width;
                        this.ctx.moveTo(this.start.x, this.start.y);
                        this.ctx.lineTo(this.end.x, this.end.y);
                        this.ctx.stroke();
                        this.ctx.closePath();
                };

                this.update = function () {
                        if (this.life > this.ttl) {
                                //re-initialize when lifespan expires
                                this.init();
                        }
                        this.life++; //add to current life
                        this.start.x += this.velocity; //move both ends of line
                        this.end.x += this.velocity;
                };

                this.init(); //initialize when new ray is created

                return this; //return local scope
        };

        function onResize() {
                //allows for resizing without effecting previously drawn objects
                if (canvas) {
                        rect = canvas.getBoundingClientRect();
                        height = rect.height;
                        width = rect.width;

                        canvas.height = osCanvas.height = height;
                        canvas.width = osCanvas.width = width;
                }
        }

        function requestAnimationFrame() {
                //vendor prefixing + fallback
                return (window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame || window.oRequestAnimationFrame || window.msRequestAnimationFrame || function (callback) {
                        window.setTimeout(callback, 1000 / 60);
                });
        }

        function wave(t, a) {
                //function credit to http://stackoverflow.com/questions/26590800/how-can-we-increment-and-then-decrement-a-counter-without-conditionals
                return Math.abs((t + a / 2) % a - a / 2);
        }

        function createObjects() {
                numRays = 80;

                objects = [];

                for (var i = 0; i < numRays; i++) {
                        //instantiate rays/particles
                        var ray = new Ray();
                        objects.push(ray);
                }
        }

        function render(c1, c2) {
                c1.clearRect(0, 0, width, height); //clear previously drawn frames
                c2.clearRect(0, 0, width, height);
                c2.shadowBlur = 10; //add a 'glow' to rays/particles
                c2.shadowColor = "white";
                c2.globalCompositeOperation = "lighter"; //lighter composite operation for more of a 'glow'
                for (var i = 0, len = objects.length; i < len; i++) {
                        //draw offscreen/update objects (rays and particles in same array)
                        var obj = objects[i];
                        obj.update();
                        obj.draw();
                }
                c1.drawImage(osCanvas, 0, 0); //copy offscreen canvas to main canvas
        }

        function loop() {
                //animation loop
                render(ctx, osCtx);
                window.requestAnimationFrame(loop);
        }

        function init() {
                //initialize canvas/globals
                canvas = document.getElementById("canvas"); //main (on-screen) canvas / context
                ctx = canvas.getContext("2d");

                osCanvas = document.createElement("canvas"); //secondary (off-screen) canvas / context
                osCtx = osCanvas.getContext("2d");

                onResize(); //set canvas size
                createObjects(); //create rays/particles
                loop(); //do a barrel roll
        }

        window.onload = init;
        window.onresize = onResize;
        window.requestAnimationFrame = requestAnimationFrame();

        //photostack plugin

        var ps = new Photostack(document.getElementById("photostack"), {
                callback: function (item) { },
                clickToFlip: true
        });
        $("#cartolina-prec").click(function () {
                ps.navigate("prev");
        });

        $("#cartolina-succ").click(function () {
                ps.navigate("next");
        });

        //google map

        var map;
        var style = [
                {
                        "featureType": "all",
                        "elementType": "geometry.fill",
                        "stylers": [
                                {
                                        "color": "#e3dfd6"
                                }
                        ]
                },
                {
                        "featureType": "all",
                        "elementType": "geometry.stroke",
                        "stylers": [
                                {
                                        "color": "#d3cdc3"
                                }
                        ]
                },
                {
                        "featureType": "all",
                        "elementType": "labels.text.fill",
                        "stylers": [
                                {
                                        "saturation": 36
                                },
                                {
                                        "color": "#333333"
                                },
                                {
                                        "lightness": 40
                                }
                        ]
                },
                {
                        "featureType": "all",
                        "elementType": "labels.text.stroke",
                        "stylers": [
                                {
                                        "visibility": "on"
                                },
                                {
                                        "color": "#ffffff"
                                },
                                {
                                        "lightness": 16
                                }
                        ]
                },
                {
                        "featureType": "all",
                        "elementType": "labels.icon",
                        "stylers": [
                                {
                                        "visibility": "off"
                                }
                        ]
                },
                {
                        "featureType": "administrative",
                        "elementType": "geometry.fill",
                        "stylers": [
                                {
                                        "color": "#fefefe"
                                },
                                {
                                        "lightness": 20
                                }
                        ]
                },
                {
                        "featureType": "administrative",
                        "elementType": "geometry.stroke",
                        "stylers": [
                                {
                                        "color": "#fefefe"
                                },
                                {
                                        "lightness": 17
                                },
                                {
                                        "weight": 1.2
                                }
                        ]
                },
                {
                        "featureType": "landscape",
                        "elementType": "geometry.fill",
                        "stylers": [
                                {
                                        "color": "#f3f1ee"
                                }
                        ]
                },
                {
                        "featureType": "landscape.man_made",
                        "elementType": "all",
                        "stylers": [
                                {
                                        "visibility": "off"
                                },
                                {
                                        "saturation": "0"
                                }
                        ]
                },
                {
                        "featureType": "landscape.man_made",
                        "elementType": "labels.text.fill",
                        "stylers": [
                                {
                                        "saturation": "0"
                                }
                        ]
                },
                {
                        "featureType": "poi",
                        "elementType": "geometry",
                        "stylers": [
                                {
                                        "lightness": 21
                                },
                                {
                                        "visibility": "off"
                                },
                                {
                                        "color": "#f5f5f5"
                                }
                        ]
                },
                {
                        "featureType": "poi.park",
                        "elementType": "geometry",
                        "stylers": [
                                {
                                        "color": "#dedede"
                                },
                                {
                                        "lightness": 21
                                }
                        ]
                },
                {
                        "featureType": "road.highway",
                        "elementType": "geometry.fill",
                        "stylers": [
                                {
                                        "color": "#ffffff"
                                },
                                {
                                        "lightness": 17
                                }
                        ]
                },
                {
                        "featureType": "road.highway",
                        "elementType": "geometry.stroke",
                        "stylers": [
                                {
                                        "color": "#ffffff"
                                },
                                {
                                        "lightness": 29
                                },
                                {
                                        "weight": 0.2
                                }
                        ]
                },
                {
                        "featureType": "road.arterial",
                        "elementType": "geometry",
                        "stylers": [
                                {
                                        "color": "#ffffff"
                                },
                                {
                                        "lightness": 18
                                }
                        ]
                },
                {
                        "featureType": "road.local",
                        "elementType": "geometry",
                        "stylers": [
                                {
                                        "color": "#ffffff"
                                },
                                {
                                        "lightness": 16
                                }
                        ]
                },
                {
                        "featureType": "transit",
                        "elementType": "geometry",
                        "stylers": [
                                {
                                        "color": "#f2f2f2"
                                },
                                {
                                        "lightness": 19
                                }
                        ]
                },
                {
                        "featureType": "water",
                        "elementType": "geometry",
                        "stylers": [
                                {
                                        "color": "#e9e5de"
                                },
                                {
                                        "lightness": 17
                                }
                        ]
                }
        ]

        var center = {
                lat: 45.0781,
                lng: 7.6761
        };
        var options = {
                zoom: 16,
                center: center,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                disableDefaultUI: true,
                scrollwheel: false,
                draggable: false,
                disableDoubleClickZoom: true
        };

        map = new google.maps.Map($('#map')[0], options);
        map.setOptions({
                styles: style
        });

        var markerBounds = new google.maps.LatLngBounds();

        var coordinate = [
                //[45.1566517, 6.8288132], //cv
                [37.4219999,-122.0862462], //email
                [45.0692421, 7.6662328], //telefono
                [49,610431, 6,12437], //skype
                [37,392684, -122,042034], //linkedin
                [37,77759, -122,396727] //pinterest
        ];

        var icone = [
                //'img/pdf.png',
                'img/gmail.png',
                'img/tim.png',
                'img/skype.png',
                'img/linkedin.png',
                'img/pinterest.png'
        ];

        coordinate.forEach( (element, i) => {
                var myLatlng = new google.maps.LatLng(element[0],element[1]);
                markerBounds.extend(myLatlng);
                var marker = new google.maps.Marker({
                        position: myLatlng,
                        title:"Hello World!",
                        icon: icone[i],
                        map: map
                    });
                    console.log('marker: ', marker);
        });



        map.fitBounds(markerBounds);

        // firma nella console.
        console.log(
                "%cQualcosa non va? Fammelo sapere!",
                "padding:9px 10px; " +
                "color: #7d2941; " +
                "line-height: 25px;");
        console.log(
                "%cScrivimi a: e.trudini82@gmail.com",
                "padding:9px 10px; " +
                "color: #C06E52; " +
                "line-height: 25px;");
});
