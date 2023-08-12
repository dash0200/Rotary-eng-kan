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

        table {
            font-size: 18px;
        }
    </style>
</head>
<body>
    
    <table style="width: 100%;" class="bb fb">
        <tr>
            <td align="center" style="font-size: 14px;">
               <div style="margin-bottom: 0.5rem;">
                NAVANAGAR ROTARY EDUCATION SOCIETY'S
               </div>
            </td>
        </tr>
        <tr>
            <td align="center" style="font-size: 18px;">
                NAVANAGAR ROTARY ENGLISH MEDIUM SCHOOL
            </td>
        </tr>
        <tr>
            <td align="center">
                NAVANAGAR, HUBBALLI-580025
            </td>
        </tr>
    </table>

    <table style="width: 100%;" class="bb fb">
        <tr>
            <td align="center">
                <div style="font-size: 20px; padding: 0.3rem;">
                    CHARACTER CERTIFICATE
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
                <span >Kumar / Kumari. </span>
            </td>

            <td align="left" style="width: 100%;" class="bb fb">
              {{strtoupper($student->name)}} {{$student->fname == null ? '' : ' '.strtoupper($student->fname)[0].' '}}  {{$student->lname==null ? '':strtoupper($student->lname)}}
            </td>
        </tr>
    </table>

    <table style="width: 100%; padding-left: 0.5rem; margin-top: 0.5rem;">
        <tr>
            <td align="left" style="width: 30%;">
                <span>Son/Daughter of  </span>
            </td>

            <td align="left" style="width: 100%;" class="bb fb">
              {{$student->fname == null ? '' : strtoupper($student->fname).' '}} {{$student->lname==null ? '': strtoupper($student->lname)}}
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
              <u class="fb">{{$study->studied_from}}</u>              
            </td>

            <td>to</td>

            <td>
                <u class="fb">{{$study->studied_to}}</u>
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
              <u class="fb">{{$study->year_from}}</u>              
            </td>

            <td>to  <u style="margin-left: 1rem;" class="fb">{{$study->year_to}}</u></td>
        </tr>
    </table>

    <table style="width: 100%; padding-left: 0.5rem; margin-top: 0.5rem;">
        <tr>
            <td style="width: 40%;">
                <span>Him/Her Registration Number is: </span>
            </td>

            <td align="center" class="bb fb">
              {{$student->id}}              
            </td>
            <td>
                and He/She belongs to caste
            </td>
        </tr>
    </table>

    <table style="width: 100%; padding-left: 0.5rem; margin-top: 1rem;  padding-bottom: 0.6rem;" class="bb">
        <tr>
            <td align="center">
                The above details are true and correct to the best of my knowledge. He/She bears good Moral Character
            </td>
        </tr>
    </table>

    <table style="width: 100%; padding-left: 0.5rem; margin-top: 10rem; padding-bottom: 0.6rem;">
        <tr>
            <td align="left">
                Date : {{date("d-m-Y")}}
            </td>
        </tr>
        <tr>
            <td align="left">
                Place : Navanagar, Hubballi.
            </td>
        </tr>
    </table>

</body>
</html>