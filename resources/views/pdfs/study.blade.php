<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>STUDY CERTIFICATE</title>
    <style>
        body {
            border: 1px solid black;
        }

        .fb {
            font-weight: bold;
        }

        .bb {
            border-bottom: 1px solid black;
        }
    </style>
</head>

<body>

    <table style="width: 100%;" class="fb">
        <tr>
            <td align="center" style="width: 5rem; font-size: 13px;">
                Estd. 1986
            </td>
            <td align="center" style="font-size: 14px; width: 100%;">
                <div style="margin-bottom: 0.5rem;">
                    NAVANAGAR ROTARY EDUCATION SOCIETY'S
                </div>
            </td>
            <td style="width: 6rem; font-size: 13px;">
                Ph: 2224144
            </td>
        </tr>
    </table>

    <table style="width: 100%;" class="bb fb">
        <tr>
            <td align="center" style="font-size: 18px; width: 100%;">
                NAVANAGAR ROTARY ENGLISH MEDIUM SCHOOL
            </td>
        </tr>
        <tr>
            <td align="center" style="width: 40%;">
                NAVANAGAR, HUBBALLI-580025
            </td>
        </tr>
        <tr>
            <td align="center">
                <div style="font-size: 11px; padding: 0.4rem;">
                    [P.Sch-Recognized by Govt. of Karnataka Vide Order No. ED.28 PGC 91 ] & [H.Sch-C8(7)
                    PEC/N.HS/042000-01]
                </div>
            </td>
        </tr>
    </table>

    <table style="width: 100%;" class="bb fb">
        <tr>
            <td align="center">
                <div style="font-size: 20px; padding: 0.3rem;">
                    STUDY CERTIFICATE
                </div>
            </td>
        </tr>
    </table>

    <table style="width: 100%;" class="fb">
        <tr>
            <td align="center">
                THIS IS TO CERTIFY THAT
            </td>
        </tr>
    </table>

    <table style="width: 100%; padding-left: 0.5rem; margin-top: 0.5rem;">
        <tr>
            <td align="left" style="width: 30%;">
                <span>KUMAR / KUMARI. </span>
            </td>

            <td align="left" style="width: 100%;" class="bb fb">
                {{ strtoupper($student->name) }}
            </td>
        </tr>
    </table>

    <table style="width: 100%; padding-left: 0.5rem; margin-top: 0.5rem;">
        <tr>
            <td align="left" style="width: 30%;">
                <span>Son/Daughter of </span>
            </td>

            <td align="left" style="width: 100%;" class="bb fb">
                {{ $student->fname == null ? '' : strtoupper($student->fname) . ' .' }}
                {{ $student->lname == null ? '' : strtoupper($student->lname) }}
            </td>
        </tr>
    </table>

    <table style="width: 100%; padding-left: 0.5rem; margin-top: 0.5rem;">
        <tr>
            <td>
                is a student of our school.
            </td>
        </tr>
    </table>

    <table style="width: 100%; padding-left: 0.5rem; margin-top: 0.5rem;">
        <tr>
            <td>
                <span>He/She Studied from</span>
            </td>

            <td>
                <u class="fb">{{ $study->from_stdy }}</u>
            </td>

            <td>to</td>

            <td>
                <u class="fb">{{ $study->to_stdy }}</u>
            </td>

            <td>
                Standard in our Instituition.
            </td>
        </tr>
    </table>

    <table style="width: 100%; padding-left: 0.5rem; margin-top: 0.5rem;">
        <tr>
            <td style="width: 40%;">
                <span>During the academic year from </span>
            </td>

            <td align="left" style="width: 10%;">
                <u class="fb">{{ $study->from_year }}</u>
            </td>

            <td>to <u style="margin-left: 1rem;" class="fb">{{ $study->to_year }}</u></td>
        </tr>
    </table>

    <table style="width: 100%; padding-left: 0.5rem; margin-top: 0.5rem;">
        <tr>
            <td style="width: 40%;">
                <span>Him/Her Registration Number is: </span>
            </td>

            <td align="center" class="bb fb">
                {{ $student->id }}
            </td>
            <td>
                and He/She belongs to caste
            </td>
        </tr>
    </table>

    <table style="width: 35%; margin-left: 7rem; margin-top: 2rem;">
        <tr>
            <td>Caste</td>
            <td>:</td>
            <td>{{ $caste }}</td>
        </tr>
        <tr>
            <td>Sub-Caste</td>
            <td>:</td>
            <td>{{ $subCaste }}</td>
        </tr>
        <tr>
            <td>Religion</td>
            <td>:</td>
            <td>{{ $student->religion }}</td>
        </tr>
    </table>

    <table style="width: 100%; padding-left: 0.5rem; margin-top: 0.5rem;">
        <tr>
            <td style="width: 40%;">
                <span>and mother tounge of the candidate is </span>
            </td>

            <td align="center" class="bb fb">
                {{ $study->mother_lang }}
            </td>
        </tr>
    </table>

    <table style="width: 100%; padding-left: 0.5rem; margin-top: 1rem;  padding-bottom: 0.6rem;" class="bb">
        <tr>
            <td align="center">
                The above details are true and correct to the best of my knowledge.
            </td>
        </tr>
    </table>

    <table style="width: 100%; padding-left: 0.5rem; margin-top: 1rem;  padding-bottom: 0.6rem;">
        <tr>
            <td align="left">
                Date : {{ date('d-m-Y') }}
            </td>
        </tr>
    </table>

    <table style="width: 100%; padding-left: 0.5rem; margin-top: 4rem;  padding-bottom: 0.6rem;" class="bb">
        <tr>
            <td align="right">
                Instituition Seal
            </td>

            <td align="center">
                <div style="margin-left: 15rem;">
                    <div>Signature of</div>
                    <div>Head of Instituition</div>
                    <div>MRS. VIJAYASHREE. V. KALBURGI</div>
                </div>
            </td>
        </tr>
    </table>

    <table style="width: 100%; padding-left: 0.5rem; padding-bottom: 0.6rem;">
        <tr>
            <td align="center">
                COUNTER SIIGNED BY ME
            </td>
        </tr>
        <tr>
            <td align="center">
                Address, Seal & Office Telephone Number of the Block Education Officer/DDPI
            </td>
        </tr>
    </table>

</body>

</html>
