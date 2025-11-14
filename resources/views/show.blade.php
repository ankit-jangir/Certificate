<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Certified {{ $name }}</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&family=Inter:wght@400;600&display=swap"
        rel="stylesheet" />

    <style>
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
            background: #eaeef3;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Inter', sans-serif;
            color: #111827;
        }

        .a4-wrap {
            width: 100%;
            max-width: 1086px;
            aspect-ratio: 1.414 / 1;
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: auto;
        }

        .certificate {
            width: 100%;
            height: 100%;
            position: relative;
            border-radius: 12px;
            overflow: hidden;
            background: #fff;
            background-image: url('{{ isset($isPdf) ? public_path('img/bg.png') : asset('img/bg.png') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            padding: 2rem;
        }

        @media screen {
            .a4-wrap {
                width: min(95vw, 1086px);
                height: auto;
                display: flex;
                justify-content: center;
                align-items: center;
            }
        }


@media screen and (max-width: 700px) {

    body {
        overflow-x: hidden;
    }

    .certificate {
        padding: 1rem;
        background-size: cover;
        background-position: center;
    }

    .overlay {
        padding: 0 5%;
        top: 55px !important;
    }

    .ov-title {
        font-size: 14px !important;
        margin-bottom: 6px !important;
    }

    .ov-line {
        font-size: 6px !important;
        line-height: 1.3;
        margin: 2px 0 !important;
    }

    .ov-line.name {
        font-size: 7px !important;
    }

    .header img {
        height: 35px !important;
    }

    .emblem {
        height: 50px !important;
        top: 5%;
    }

    .qr-section {
        position: absolute;
        bottom: 25px !important;
        left: 10px !important;
        text-align: center;
    }

    .qr-section img {
        width: 45px !important;
        height: 45px !important;
    }

    .qr-section small {
        font-size: 4px !important;
        font-weight: 600;
    }

    .sign-section {
        right: 40px !important;
        bottom: 25px !important;
        text-align: center !important;
    }

    .sign-section img {
        height: 25px !important;
    }

    .sign-section .line {
        width: 80px !important;
        height: 1px !important;
        margin-bottom: 0px !important
    }

    .sign-section strong {
        font-size: 6px !important;
    }

    .sign-section small {
        font-size: 4px !important;
        line-height: 1.2;
    }

    .bottom-brand {
        bottom: 20px !important;
    }

    .bottom-brand img {
        height: 80px !important;
    }

    .decor {
        background-size: auto 90% !important;
    }
}

@media screen and (min-width: 701px) and (max-width: 1024px) {

    .certificate {
        padding: 1.5rem;
        background-size: cover;
    }

    .overlay {
        top: 20% !important;
        padding: 0 6%;
    }

    .ov-title {
        font-size: 18px !important;
    }

    .ov-line {
        font-size: 11px !important;
        line-height: 1.4;
    }

    .ov-line.name {
        font-size: 14px !important;
    }

    .qr-section {
        bottom: 125px !important;
        left: 30px !important;
    }

    .qr-section img {
        width: 70px !important;
        height: 70px !important;
    }

    .qr-section small {
        font-size: 10px !important;
    }

    .sign-section {
        right: 50px !important;
        bottom: 125px !important;
    }

    .sign-section img {
        height: 40px !important;
    }

    .sign-section .line {
        width: 140px !important;
        height: 2px !important;
    }

    .sign-section strong {
        font-size: 12px !important;
    }

    .sign-section small {
        font-size: 9px !important;
    }

     .bottom-brand {
        bottom: 125px !important;
    }

    .bottom-brand img {
        height: 120px !important;
    }

    .decor {
        background-size: auto 75% !important;
    }
}



        @media print {
            @page {
                size: A4 landscape;
                margin: 0;
            }

            html,
            body {
                margin: 0;
                padding: 0;
                background: #fff;
                width: 100%;
                height: 100%;
            }

            .a4-wrap {
                width: 100%;
                height: 100%;
                max-width: 100%;
                margin: 0 auto;
                display: flex;
                justify-content: center;
                align-items: center;
                page-break-inside: avoid;
            }

            .certificate {
                width: 287mm !important;
                height: 197mm !important;
                box-shadow: none;
                border-radius: 0;
                padding: 24px 32px;
                background-size: cover;
                page-break-inside: avoid;
            }

            .print-hide {
                display: none !important;
            }
        }


        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header img {
            height: clamp(60px, 10vw, 120px);
            object-fit: contain;
            max-width: 45%;
        }

        .emblem {
            position: absolute;
            /* top: 5%; */
            left: 50%;
            transform: translateX(-50%);
            height: clamp(80px, 12vw, 140px);
        }


        .overlay {
            position: absolute;
            top: 150px;
            left: 0;
            right: 0;
            text-align: center;
            display: flex;
            justify-content: flex-start;
            align-items: center;
            flex-direction: column;
            padding: 0 5%;
            transform: none;
        }

        .ov-title {
            font-family: 'Merriweather', serif;
            font-size: clamp(22px, 3vw, 36px);
            font-weight: 700;
            letter-spacing: 1px;
            color: #ababab;
            margin-bottom: clamp(10px, 2vw, 20px);
        }

        .ov-line {
            font-size: clamp(12px, 1.5vw, 18px);
            color: #222;
            line-height: 1.6;
            margin: 4px 0;
        }

        .ov-line.name {
            font-family: 'Merriweather', serif;
            font-weight: 700;
            font-size: clamp(14px, 2vw, 22px);
            color: #000;
        }

        .ov-line strong {
            font-weight: 700;
            font-family: 'Merriweather', serif;
            color: #000;
        }

        .qr-section {
            position: absolute;
            bottom: 100px;
            left: clamp(20px, 6vw, 70px);
            text-align: center;
        }

        .qr-section img {
            width: clamp(80px, 10vw, 120px);
            height: clamp(80px, 10vw, 120px);
        }

        .qr-section small {
            display: block;
            font-size: 13px;
            color: black;
            margin-top: 6px;
            font-weight: 700
        }


        .sign-section {
            position: absolute;
            right: 110px;
            bottom: 100px;
            text-align: center;
        }

        .sign-section img {
            height: clamp(40px, 5vw, 60px);
        }

        .sign-section .line {
            width: clamp(140px, 20vw, 220px);
            height: 3px;
            background: #000;
            margin-bottom: 5px;
            margin-left: 1px;
        }

        .sign-section strong {
            font-size: 17px;
            font-weight: 700
        }

        .sign-section small {
            display: block;
            font-size: 12px;
            color: black;
            font-weight: 700
        }

        .bottom-brand {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            bottom: 100px;
            text-align: center;
        }

        .bottom-brand img {
            height: 160px;
            object-fit: contain;
        }

        .decor {
            position: absolute;
            right: 0;
            top: 0;
            width: clamp(40px, 8vw, 100px);
            height: 100%;
            background-image: url('{{ isset($isPdf) ? public_path('img/rightimg.png') : asset('img/rightimg.png') }}');
            background-repeat: no-repeat;
            background-size: auto 90%;
            background-position: right center;
        }
    </style>
</head>

<body>
 @if (isset($id) && !isset($isPdf))
    <div class="print-hide" 
         style="position:fixed; right:16px; top:16px; z-index:50; display:flex; align-items:center;">
        <a href="#" onclick="window.print(); return false;" rel="noopener"
           style="display:flex; align-items:center; gap:8px; padding:10px 16px; border-radius:8px;
                  background:linear-gradient(135deg,#2563eb,#1e40af); color:#fff; 
                  text-decoration:none; font-weight:600; box-shadow:0 4px 12px rgba(0,0,0,0.2);
                  transition:all 0.3s ease;">
            <span>Download & Print</span>
        </a>
    </div>
@endif


    <div class="a4-wrap">
        <div class="certificate">
            <div class="decor"></div>


            <div class="header">
                <img src="{{ isset($isPdf) ? public_path('img/skillindia.png') : asset('img/skillindia.png') }}"
                    alt="Skill India">
                <img src="{{ isset($isPdf) ? public_path('img/gover.png') : asset('img/gover.png') }}" class="emblem"
                    alt="India Emblem">
                <img src="{{ isset($isPdf) ? public_path('img/N.S.D.c.png') : asset('img/N.S.D.c.png') }}"
                    alt="NSDC">
            </div>


            <div class="overlay">
                <div class="ov-title">CERTIFIED TRAINER</div>
                <div class="ov-line">This is to certify that</div>

                <div class="ov-line name">
                    <strong>{{ $name ?? 'Trainer Name' }}</strong>
                    (Aadhaar No - {{ $aadhar ?? 'XXXXXXXXX5601' }})
                    with Trainer ID - <strong>{{ $trainerId ?? 'TR000000' }}</strong>
                </div>

                <div class="ov-line">has successfully cleared the assessment as</div>

                <div class="ov-line">
                    <strong>Trainer with Grade '{{ $grade ?? 'B' }}'</strong>
                </div>

                <div class="ov-line">
                    For the Qualification Pack of
                    <strong>{{ $qpName ?? 'Infrastructure Management Services' }}
                        ({{ $qpCode ?? 'SSC/Q0801' }})-v5.0</strong>
                </div>

                <div class="ov-line">
                    Conforming to National Skill Qualification Framework Level -
                    <strong>{{ $level ?? '5' }}</strong>
                </div>

                <div class="ov-line">
                    Date of Issue: <strong>{{ $issue_date ?? '13/03/2014' }}</strong>

                </div>

            </div>

            <div class="bottom-section">


                <div class="qr-section">
                    @php
                        $qrSrc = isset($qrCodePath) ? $qrCodePath : 'img/QRcode.png';
                        $qrFull = isset($isPdf) ? public_path($qrSrc) : asset($qrSrc);
                    @endphp
                    <img src="{{ $qrFull }}" alt="QR Code">
                    <small>{{ $qrRef ?? 'TOT/SSC/Q0801V5.0/252052/TR200150/244870' }}</small>
                </div>

                <div class="bottom-brand">
                    <img src="{{ isset($isPdf) ? public_path('img/Nasscom.png') : asset('img/Nasscom.png') }}"
                        alt="NASSCOM Logo">
                </div>

                <div class="sign-section">
                    <div class="line"></div>
                    <strong>Dr. Sandhya Chintala</strong>
                    <small>Executive Director,<br>IT-ITeS Sector-Skills Council NASSCOM<br>Vice President,
                        NASSCOM</small>
                </div>

            </div>

        </div>
    </div>
</body>

</html>
