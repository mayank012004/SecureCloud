<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>SecureCloud | Black Hole Security Center</title>

<style>

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

html,
body {
    width: 100%;
    height: 100%;
    overflow: hidden;
    background: #000;
    color: white;
    font-family: Arial, Helvetica, sans-serif;
}

body {
    background:
        radial-gradient(
            ellipse at center,
            #0a1016 0%,
            #030609 42%,
            #000 100%
        );
}


/* =========================================================
   THREE.JS
========================================================= */

#space {
    position: fixed;
    inset: 0;
    width: 100%;
    height: 100%;
    z-index: 1;
}

#space canvas {
    display: block;
    width: 100% !important;
    height: 100% !important;
}


/* =========================================================
   VIGNETTE
========================================================= */

.vignette {
    position: fixed;
    inset: 0;
    z-index: 5;
    pointer-events: none;

    background:
        radial-gradient(
            ellipse at center,
            transparent 34%,
            rgba(0,0,0,0.18) 58%,
            rgba(0,0,0,0.82) 100%
        );
}


/* =========================================================
   NAVBAR
========================================================= */

.navbar {
    position: fixed;
    top: 0;
    left: 0;

    width: 100%;
    height: 64px;

    z-index: 20;

    display: flex;
    align-items: center;
    justify-content: space-between;

    padding: 0 30px;

    background:
        linear-gradient(
            180deg,
            rgba(1,4,8,0.94),
            rgba(1,4,8,0.35)
        );

    border-bottom:
        1px solid
        rgba(140,190,210,0.10);

    backdrop-filter: blur(10px);
}

.brand {
    display: flex;
    align-items: center;
    gap: 11px;

    font-size: 18px;
    font-weight: 600;

    letter-spacing: 1px;
}

.brand-icon {
    width: 31px;
    height: 31px;

    border-radius: 50%;

    display: flex;
    align-items: center;
    justify-content: center;

    background:
        radial-gradient(
            circle at 35% 30%,
            #ffffff,
            #68c8e8 38%,
            #0876a5 65%,
            #01111b
        );

    box-shadow:
        0 0 16px
        rgba(60,200,245,0.60);
}

.nav {
    display: flex;
    align-items: center;
    gap: 23px;
}

.nav a {
    color:
        rgba(230,240,245,0.62);

    text-decoration: none;

    font-size: 11px;

    letter-spacing: 0.8px;

    transition: 0.25s;
}

.nav a:hover {
    color: white;

    text-shadow:
        0 0 12px
        rgba(100,210,255,0.8);
}

.logout {
    padding: 7px 13px;

    border:
        1px solid
        rgba(150,190,205,0.16);

    border-radius: 5px;

    background:
        rgba(255,255,255,0.035);
}


/* =========================================================
   TITLE
========================================================= */

.title {
    position: fixed;

    top: 91px;
    left: 38px;

    z-index: 10;

    pointer-events: none;
}

.title h1 {
    font-size: 27px;

    font-weight: 500;

    letter-spacing: 0.3px;

    text-shadow:
        0 0 25px
        rgba(255,120,40,0.15);
}

.title p {
    margin-top: 8px;

    font-size: 8px;

    letter-spacing: 3px;

    color:
        rgba(190,215,225,0.42);
}


/* =========================================================
   STATUS
========================================================= */

.status {
    position: fixed;

    top: 92px;
    right: 36px;

    z-index: 10;

    display: flex;
    align-items: center;

    gap: 8px;

    padding: 8px 13px;

    border-radius: 20px;

    background:
        rgba(7,24,27,0.25);

    border:
        1px solid
        rgba(55,220,170,0.20);

    backdrop-filter:
        blur(8px);

    color:
        rgba(220,245,238,0.68);

    font-size: 10px;

    letter-spacing: 0.5px;
}

.status-dot {
    width: 6px;
    height: 6px;

    border-radius: 50%;

    background: #41e4a0;

    box-shadow:
        0 0 8px #41e4a0;

    animation:
        statusPulse 2s infinite;
}

@keyframes statusPulse {

    0%,
    100% {
        opacity: 1;
        transform: scale(1);
    }

    50% {
        opacity: .35;
        transform: scale(.7);
    }

}


/* =========================================================
   LEFT TELEMETRY
========================================================= */

.telemetry {
    position: fixed;

    left: 36px;
    bottom: 27px;

    z-index: 10;

    width: 260px;

    pointer-events: none;
}

.telemetry-label {
    font-size: 8px;

    letter-spacing: 2px;

    color:
        rgba(130,205,225,0.43);

    margin-bottom: 6px;
}

.telemetry-line {
    height: 17px;

    display: flex;
    align-items: center;

    gap: 2px;
}

.telemetry-line span {
    width: 2px;

    background:
        rgba(65,207,235,0.55);

    display: block;

    animation:
        telemetryPulse
        1.4s infinite
        ease-in-out;
}

.telemetry-line span:nth-child(1) {
    height: 4px;
}

.telemetry-line span:nth-child(2) {
    height: 8px;
    animation-delay: .1s;
}

.telemetry-line span:nth-child(3) {
    height: 12px;
    animation-delay: .2s;
}

.telemetry-line span:nth-child(4) {
    height: 6px;
    animation-delay: .3s;
}

.telemetry-line span:nth-child(5) {
    height: 15px;
    animation-delay: .4s;
}

.telemetry-line span:nth-child(6) {
    height: 9px;
    animation-delay: .5s;
}

.telemetry-line span:nth-child(7) {
    height: 13px;
    animation-delay: .6s;
}

.telemetry-line span:nth-child(8) {
    height: 7px;
    animation-delay: .7s;
}

.telemetry-line span:nth-child(9) {
    height: 11px;
    animation-delay: .8s;
}

.telemetry-line span:nth-child(10) {
    height: 5px;
    animation-delay: .9s;
}

@keyframes telemetryPulse {

    0%,
    100% {
        opacity: .18;
    }

    50% {
        opacity: 1;
    }

}


/* =========================================================
   RIGHT EVENT HUD
========================================================= */

.events {
    position: fixed;

    right: 36px;
    bottom: 27px;

    z-index: 10;

    width: 205px;

    pointer-events: none;
}

.events-header {
    display: flex;

    justify-content: space-between;
    align-items: center;

    margin-bottom: 6px;

    font-size: 8px;

    letter-spacing: 2px;

    color:
        rgba(155,210,225,0.45);
}

.events-header strong {
    color:
        rgba(65,230,175,0.72);

    font-size: 8px;

    font-weight: 400;
}

.event {
    height: 18px;

    display: flex;
    align-items: center;

    gap: 7px;

    border-bottom:
        1px solid
        rgba(120,190,210,0.055);

    font-size: 8px;

    color:
        rgba(200,225,235,0.42);
}

.event-dot {
    width: 4px;
    height: 4px;

    border-radius: 50%;

    background:
        #4ee5c0;

    box-shadow:
        0 0 7px
        rgba(60,235,195,0.8);
}


/* =========================================================
   LOADING
========================================================= */

#loading {
    position: fixed;

    inset: 0;

    z-index: 100;

    display: flex;

    align-items: center;
    justify-content: center;

    background: #000;

    transition:
        opacity 1.3s;
}

.loading-text {
    font-size: 10px;

    letter-spacing: 5px;

    color:
        rgba(190,225,240,0.60);
}


/* =========================================================
   MOBILE
========================================================= */

@media (max-width: 700px) {

    .title {
        left: 20px;
        top: 84px;
    }

    .title h1 {
        font-size: 21px;
    }

    .status {
        right: 20px;
        top: 87px;
    }

    .events {
        display: none;
    }

    .telemetry {
        left: 20px;
        bottom: 20px;
    }

}

</style>

</head>


<body>


<!-- =====================================================
     LOADING
===================================================== -->

<div id="loading">

    <div class="loading-text">
        SECURECLOUD INITIALIZING
    </div>

</div>


<!-- =====================================================
     THREE JS CONTAINER
===================================================== -->

<div id="space"></div>

<div class="vignette"></div>


<!-- =====================================================
     NAVBAR
===================================================== -->

<nav class="navbar">

    <div class="brand">

        <div class="brand-icon">
            ◉
        </div>

        <span>
            SecureCloud
        </span>

    </div>


    <div class="nav">

        <a href="/dashboard">
            DASHBOARD
        </a>

   <a href="/applications">
    APPLICATIONS
   </a>

        <a href="/profile">
            PROFILE
        </a>

        @if (session('local_user_role') === 'admin')

    <a href="/users">
        USERS
    </a>

    <a href="/admin">
        ADMIN
    </a>

@endif

        <a href="/logout" class="logout">
            LOGOUT
        </a>

    </div>

</nav>


<!-- =====================================================
     TITLE
===================================================== -->

<div class="title">

    <h1>
        Security Command Center
    </h1>

    <p>
        CLOUD SECURITY • IDENTITY • ACCESS CONTROL
    </p>

</div>


<!-- =====================================================
     STATUS
===================================================== -->

<div class="status">

    <span class="status-dot"></span>

    SYSTEM SECURE

</div>


<!-- =====================================================
     TELEMETRY
===================================================== -->

<div class="telemetry">

    <div class="telemetry-label">
        SECURITY SIGNAL // 96
    </div>

    <div class="telemetry-line">

        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>

    </div>

</div>


<!-- =====================================================
     LIVE EVENTS
===================================================== -->

<div class="events">

    <div class="events-header">

        <span>
            EVENT STREAM
        </span>

        <strong>
            ● LIVE
        </strong>

    </div>


    <div id="eventList">

        <div class="event">

            <span class="event-dot"></span>

            LOGIN VERIFIED

        </div>


        <div class="event">

            <span class="event-dot"></span>

            TOKEN VALIDATED

        </div>


        <div class="event">

            <span class="event-dot"></span>

            SESSION SECURED

        </div>

    </div>

</div>


<!-- =====================================================
     THREE.JS
===================================================== -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>


<script>


/* =========================================================
   SCENE
========================================================= */

const scene =
    new THREE.Scene();


const camera =
    new THREE.PerspectiveCamera(

        38,

        window.innerWidth /
        window.innerHeight,

        0.1,

        1000

    );


camera.position.set(

    0,
    0.20,
    5.25

);


const renderer =
    new THREE.WebGLRenderer({

        antialias: true,

        alpha: true

    });


renderer.setPixelRatio(

    Math.min(
        window.devicePixelRatio,
        2
    )

);


renderer.setSize(

    window.innerWidth,

    window.innerHeight

);


document
    .getElementById("space")
    .appendChild(
        renderer.domElement
    );


/* =========================================================
   AMBIENT LIGHT
========================================================= */

const ambient =
    new THREE.AmbientLight(

        0x071016,

        0.08

    );


scene.add(
    ambient
);


/* =========================================================
   BLACK HOLE
========================================================= */

const blackHoleGeometry =
    new THREE.SphereGeometry(

        0.67,

        128,

        128

    );


const blackHoleMaterial =
    new THREE.MeshBasicMaterial({

        color:
            0x000000

    });


const blackHole =
    new THREE.Mesh(

        blackHoleGeometry,

        blackHoleMaterial

    );


scene.add(
    blackHole
);


/* =========================================================
   EVENT HORIZON
========================================================= */

const horizonGeometry =
    new THREE.SphereGeometry(

        0.73,

        128,

        128

    );


const horizonMaterial =
    new THREE.ShaderMaterial({

        transparent: true,

        side:
            THREE.BackSide,

        depthWrite: false,

        blending:
            THREE.AdditiveBlending,


        vertexShader: `

            varying vec3 vNormal;

            void main() {

                vNormal =
                    normalize(
                        normalMatrix *
                        normal
                    );

                gl_Position =
                    projectionMatrix *
                    modelViewMatrix *
                    vec4(
                        position,
                        1.0
                    );

            }

        `,


        fragmentShader: `

            varying vec3 vNormal;

            void main() {

                float rim =
                    pow(
                        1.0 -
                        abs(vNormal.z),
                        4.0
                    );

                vec3 color =
                    vec3(
                        1.0,
                        0.22,
                        0.025
                    );

                gl_FragColor =
                    vec4(
                        color,
                        rim * 0.42
                    );

            }

        `

    });


const horizon =
    new THREE.Mesh(

        horizonGeometry,

        horizonMaterial

    );


scene.add(
    horizon
);


/* =========================================================
   MAIN ACCRETION DISK
========================================================= */

const diskGeometry =
    new THREE.RingGeometry(

        0.77,

        2.15,

        320,

        48

    );


const diskMaterial =
    new THREE.ShaderMaterial({

        transparent: true,

        side:
            THREE.DoubleSide,

        depthWrite: false,

        blending:
            THREE.AdditiveBlending,

        uniforms: {

            time: {
                value: 0
            }

        },


        vertexShader: `

            varying vec2 vUv;

            varying float radiusValue;


            void main() {

                vUv = uv;

                radiusValue =
                    length(position.xy);


                vec3 p =
                    position;


                float distortion =
                    sin(
                        radiusValue * 18.0
                    ) *
                    0.012;


                p.z += distortion;


                gl_Position =
                    projectionMatrix *
                    modelViewMatrix *
                    vec4(
                        p,
                        1.0
                    );

            }

        `,


        fragmentShader: `

            uniform float time;

            varying vec2 vUv;

            varying float radiusValue;


            void main() {


                float inner =
                    smoothstep(
                        0.77,
                        0.90,
                        radiusValue
                    );


                float outer =
                    1.0 -
                    smoothstep(
                        1.72,
                        2.16,
                        radiusValue
                    );


                float radial =
                    inner *
                    outer;


                float spiralA =
                    sin(
                        vUv.x * 80.0
                        -
                        time * 3.5
                        +
                        radiusValue * 20.0
                    );


                float spiralB =
                    sin(
                        vUv.x * 35.0
                        +
                        time * 1.7
                        -
                        radiusValue * 9.0
                    );


                float turbulence =
                    (
                        spiralA +
                        spiralB
                    ) * 0.5;


                turbulence =
                    turbulence *
                    0.5 +
                    0.5;


                float heat =
                    1.0 -
                    smoothstep(
                        0.80,
                        1.85,
                        radiusValue
                    );


                vec3 whiteHot =
                    vec3(
                        1.0,
                        0.92,
                        0.70
                    );


                vec3 yellow =
                    vec3(
                        1.0,
                        0.55,
                        0.20
                    );


                vec3 orange =
                    vec3(
                        0.95,
                        0.18,
                        0.025
                    );


                vec3 darkOrange =
                    vec3(
                        0.22,
                        0.018,
                        0.004
                    );


                vec3 color;


                color =
                    mix(
                        orange,
                        whiteHot,
                        heat
                    );


                color =
                    mix(
                        darkOrange,
                        color,
                        turbulence
                    );


                float brightCore =
                    smoothstep(
                        1.15,
                        0.78,
                        radiusValue
                    );


                color +=
                    whiteHot *
                    brightCore *
                    0.42;


                float alpha =
                    radial *
                    (
                        0.48 +
                        turbulence * 0.52
                    );


                gl_FragColor =
                    vec4(
                        color,
                        alpha
                    );

            }

        `

    });


const disk =
    new THREE.Mesh(

        diskGeometry,

        diskMaterial

    );


disk.rotation.x =
    Math.PI / 2.35;


disk.rotation.z =
    -0.08;


scene.add(
    disk
);


/* =========================================================
   SECOND ACCRETION DISK
========================================================= */

const disk2Geometry =
    new THREE.RingGeometry(

        0.85,

        2.48,

        320,

        32

    );


const disk2Material =
    new THREE.ShaderMaterial({

        transparent: true,

        side:
            THREE.DoubleSide,

        depthWrite: false,

        blending:
            THREE.AdditiveBlending,

        uniforms: {

            time: {
                value: 0
            }

        },


        vertexShader: `

            varying vec2 vUv;

            void main() {

                vUv = uv;

                gl_Position =
                    projectionMatrix *
                    modelViewMatrix *
                    vec4(
                        position,
                        1.0
                    );

            }

        `,


        fragmentShader: `

            uniform float time;

            varying vec2 vUv;


            void main() {


                float y =
                    abs(
                        vUv.y -
                        0.5
                    );


                float band =
                    1.0 -
                    smoothstep(
                        0.02,
                        0.47,
                        y
                    );


                float waves =
                    sin(
                        vUv.x * 70.0 -
                        time * 2.0
                    );


                waves =
                    waves * 0.5 +
                    0.5;


                vec3 color =
                    mix(

                        vec3(
                            0.55,
                            0.035,
                            0.005
                        ),

                        vec3(
                            1.0,
                            0.70,
                            0.36
                        ),

                        waves

                    );


                gl_FragColor =
                    vec4(
                        color,
                        band * 0.12
                    );

            }

        `

    });


const disk2 =
    new THREE.Mesh(

        disk2Geometry,

        disk2Material

    );


disk2.rotation.copy(
    disk.rotation
);


scene.add(
    disk2
);


/* =========================================================
   PHOTON RINGS
========================================================= */

function createPhotonRing(

    radius,
    thickness,
    opacity

) {

    const geometry =
        new THREE.RingGeometry(

            radius - thickness,

            radius + thickness,

            320

        );


    const material =
        new THREE.MeshBasicMaterial({

            color:
                0xffb45c,

            transparent:
                true,

            opacity:
                opacity,

            side:
                THREE.DoubleSide,

            blending:
                THREE.AdditiveBlending,

            depthWrite:
                false

        });


    const ring =
        new THREE.Mesh(

            geometry,

            material

        );


    ring.rotation.copy(
        disk.rotation
    );


    scene.add(
        ring
    );


    return ring;

}


const photonRing =
    createPhotonRing(

        0.78,
        0.010,
        0.72

    );


const photonRing2 =
    createPhotonRing(

        0.86,
        0.006,
        0.22

    );


const photonRing3 =
    createPhotonRing(

        1.00,
        0.003,
        0.07

    );


/* =========================================================
   DUST
========================================================= */

const dustCount =
    4500;


const dustGeometry =
    new THREE.BufferGeometry();


const dustPositions =
    new Float32Array(

        dustCount * 3

    );


for (

    let i = 0;

    i < dustCount;

    i++

) {

    const angle =
        Math.random() *
        Math.PI *
        2;


    const radius =
        0.83 +
        Math.pow(
            Math.random(),
            0.65
        ) *
        2.9;


    const thickness =
        0.015 +
        radius *
        0.025;


    const vertical =
        (
            Math.random() -
            0.5
        ) *
        thickness;


    const index =
        i * 3;


    dustPositions[index] =
        Math.cos(angle) *
        radius;


    dustPositions[index + 1] =
        vertical;


    dustPositions[index + 2] =
        Math.sin(angle) *
        radius;

}


dustGeometry.setAttribute(

    "position",

    new THREE.BufferAttribute(

        dustPositions,

        3

    )

);


const dustMaterial =
    new THREE.PointsMaterial({

        color:
            0xff8240,

        size:
            0.018,

        transparent:
            true,

        opacity:
            0.38,

        blending:
            THREE.AdditiveBlending,

        depthWrite:
            false

    });


const dust =
    new THREE.Points(

        dustGeometry,

        dustMaterial

    );


dust.rotation.copy(
    disk.rotation
);


scene.add(
    dust
);


/* =========================================================
   STAR FIELD
========================================================= */

const starsGeometry =
    new THREE.BufferGeometry();


const starCount =
    7200;


const starsPositions =
    new Float32Array(

        starCount * 3

    );


for (

    let i = 0;

    i < starCount * 3;

    i += 3

) {

    const radius =
        22 +
        Math.random() *
        85;


    const theta =
        Math.random() *
        Math.PI *
        2;


    const phi =
        Math.acos(
            2 *
            Math.random() -
            1
        );


    starsPositions[i] =
        radius *
        Math.sin(phi) *
        Math.cos(theta);


    starsPositions[i + 1] =
        radius *
        Math.sin(phi) *
        Math.sin(theta);


    starsPositions[i + 2] =
        radius *
        Math.cos(phi);

}


starsGeometry.setAttribute(

    "position",

    new THREE.BufferAttribute(

        starsPositions,

        3

    )

);


const starsMaterial =
    new THREE.PointsMaterial({

        color:
            0xd6eaff,

        size:
            0.030,

        transparent:
            true,

        opacity:
            0.72

    });


const stars =
    new THREE.Points(

        starsGeometry,

        starsMaterial

    );


scene.add(
    stars
);


/* =========================================================
   BLUE SPACE DUST
========================================================= */

const blueDustGeometry =
    new THREE.BufferGeometry();


const blueDustCount =
    800;


const blueDustPositions =
    new Float32Array(

        blueDustCount * 3

    );


for (

    let i = 0;

    i < blueDustCount * 3;

    i += 3

) {

    const radius =
        5 +
        Math.random() *
        13;


    const angle =
        Math.random() *
        Math.PI *
        2;


    blueDustPositions[i] =
        Math.cos(angle) *
        radius;


    blueDustPositions[i + 1] =
        (
            Math.random() -
            0.5
        ) *
        5;


    blueDustPositions[i + 2] =
        Math.sin(angle) *
        radius;

}


blueDustGeometry.setAttribute(

    "position",

    new THREE.BufferAttribute(

        blueDustPositions,

        3

    )

);


const blueDust =
    new THREE.Points(

        blueDustGeometry,

        new THREE.PointsMaterial({

            color:
                0x376f91,

            size:
                0.025,

            transparent:
                true,

            opacity:
                0.18,

            blending:
                THREE.AdditiveBlending

        })

    );


scene.add(
    blueDust
);


/* =========================================================
   ORBITAL SECURITY RINGS
========================================================= */

function createOrbit(

    radius,
    opacity,
    rotationX,
    rotationZ

) {

    const geometry =
        new THREE.TorusGeometry(

            radius,

            0.0025,

            8,

            260

        );


    const material =
        new THREE.MeshBasicMaterial({

            color:
                0x38c8ef,

            transparent:
                true,

            opacity:
                opacity

        });


    const orbit =
        new THREE.Mesh(

            geometry,

            material

        );


    orbit.rotation.x =
        rotationX;


    orbit.rotation.z =
        rotationZ;


    scene.add(
        orbit
    );


    return orbit;

}


const orbit1 =
    createOrbit(

        1.55,
        0.24,
        Math.PI / 2.5,
        0.20

    );


const orbit2 =
    createOrbit(

        1.82,
        0.12,
        Math.PI / 2.9,
        -0.40

    );


const orbit3 =
    createOrbit(

        2.12,
        0.07,
        Math.PI / 2.15,
        0.70

    );


/* =========================================================
   SECURITY NODES
========================================================= */

const securityNodes = [];


for (

    let i = 0;

    i < 5;

    i++

) {

    const node =
        new THREE.Mesh(

            new THREE.SphereGeometry(

                0.016,

                10,

                10

            ),

            new THREE.MeshBasicMaterial({

                color:
                    0x58dcff

            })

        );


    scene.add(
        node
    );


    securityNodes.push({

        mesh:
            node,

        angle:
            i *
            (
                Math.PI *
                2 /
                5
            )

    });

}


/* =========================================================
   MOUSE
========================================================= */

let mouseX = 0;

let mouseY = 0;


document.addEventListener(

    "mousemove",

    function(event) {

        mouseX =
            (
                event.clientX /
                window.innerWidth -
                0.5
            ) *
            0.20;


        mouseY =
            (
                event.clientY /
                window.innerHeight -
                0.5
            ) *
            0.12;

    }

);


/* =========================================================
   CLOCK
========================================================= */

const clock =
    new THREE.Clock();


/* =========================================================
   ANIMATION
========================================================= */

function animate() {

    requestAnimationFrame(
        animate
    );


    const time =
        clock.getElapsedTime();


    /* -----------------------------------------
       DISK SHADERS
    ----------------------------------------- */

    diskMaterial
        .uniforms
        .time
        .value =
            time;


    /*
       IMPORTANT:
       disk2Material is not a standalone
       variable used here anymore.

       We access it safely through disk2.material.
    */

    disk2.material
        .uniforms
        .time
        .value =
            time * 0.72;


    /* -----------------------------------------
       ACCRETION DISK
    ----------------------------------------- */

    disk.rotation.z +=
        0.00065;


    disk2.rotation.z +=
        0.00078;


    dust.rotation.z +=
        0.00072;


    /* -----------------------------------------
       BLACK HOLE
    ----------------------------------------- */

    blackHole.rotation.y +=
        0.0003;


    horizon.rotation.y =
        blackHole.rotation.y;


    /* -----------------------------------------
       PHOTON RINGS
    ----------------------------------------- */

    photonRing.rotation.z +=
        0.00035;


    photonRing2.rotation.z -=
        0.00022;


    photonRing3.rotation.z +=
        0.00014;


    /* -----------------------------------------
       ORBITAL RINGS
    ----------------------------------------- */

    orbit1.rotation.z +=
        0.00038;


    orbit2.rotation.z -=
        0.00026;


    orbit3.rotation.z +=
        0.00016;


    /* -----------------------------------------
       SECURITY NODES
    ----------------------------------------- */

    securityNodes.forEach(

        function(node) {

            node.angle +=
                0.0038;


            const radius =
                1.57;


            node.mesh.position.x =
                Math.cos(
                    node.angle
                ) *
                radius;


            node.mesh.position.z =
                Math.sin(
                    node.angle
                ) *
                radius;


            node.mesh.position.y =
                0.08 *
                Math.sin(
                    node.angle * 2
                );

        }

    );


    /* -----------------------------------------
       STARS
    ----------------------------------------- */

    stars.rotation.y +=
        0.000022;


    stars.rotation.x +=
        0.000006;


    blueDust.rotation.y +=
        0.00008;


    /* -----------------------------------------
       CAMERA PARALLAX
    ----------------------------------------- */

    camera.position.x +=

        (
            mouseX * 0.18 -
            camera.position.x
        ) *
        0.006;


    camera.position.y +=

        (
            -mouseY * 0.12 -
            camera.position.y
        ) *
        0.006;


    camera.lookAt(

        0,
        0,
        0

    );


    /* -----------------------------------------
       RENDER
    ----------------------------------------- */

    renderer.render(

        scene,

        camera

    );

}


animate();


/* =========================================================
   RESIZE
========================================================= */

window.addEventListener(

    "resize",

    function() {

        camera.aspect =
            window.innerWidth /
            window.innerHeight;


        camera.updateProjectionMatrix();


        renderer.setSize(

            window.innerWidth,

            window.innerHeight

        );

    }

);


/* =========================================================
   LIVE SECURITY EVENTS
========================================================= */

const securityEvents = [

    "LOGIN VERIFIED",

    "IDENTITY VERIFIED",

    "TOKEN VALIDATED",

    "SESSION SECURED",

    "ACCESS GRANTED",

    "AUTH REQUEST",

    "SECURITY CHECK",

    "CLOUD IDENTITY"

];


let eventIndex = 0;


setInterval(

    function() {

        const list =
            document.getElementById(
                "eventList"
            );


        const item =
            document.createElement(
                "div"
            );


        item.className =
            "event";


        item.innerHTML = `

            <span class="event-dot"></span>

            ${securityEvents[eventIndex]}

        `;


        list.prepend(
            item
        );


        while (

            list.children.length >
            3

        ) {

            list.removeChild(
                list.lastChild
            );

        }


        eventIndex++;


        if (

            eventIndex >=
            securityEvents.length

        ) {

            eventIndex = 0;

        }

    },

    4200

);


/* =========================================================
   REMOVE LOADING SCREEN
========================================================= */

window.addEventListener(

    "load",

    function() {

        setTimeout(

            function() {

                const loading =
                    document.getElementById(
                        "loading"
                    );


                loading.style.opacity =
                    "0";


                setTimeout(

                    function() {

                        loading.style.display =
                            "none";

                    },

                    1300

                );

            },

            1000

        );

    }

);

</script>

</body>

</html>
