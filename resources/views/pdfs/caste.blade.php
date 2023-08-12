<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CASTE CERTIFICATE</title>
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

        table{
            padding-top: 0.5; padding-bottom: 1rem;
            font-size: 18px;
        }
    </style>
</head>
<body>
    
    <table style="width: 100%;" class="bb fb">
        <tr>
            <td align="center" style="font-size: 14px;" >
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

    <table style="width: 100%; padding: 0px" class="bb fb">
        <tr>
            <td align="center">
                <div style="font-size: 20px; padding: 0.3rem;">
                    CASTE CERTIFICATE
                </div>
            </td>
        </tr>
    </table>

    <table style="width: 100%; margin-top: 4rem ;margin-bottom: 1rem;" class="fb">
        <tr>
            <td align="center">
                THIS IS TO CERTIFY THAT
            </td>
        </tr>
    </table>

    <table style="width: 100%; padding-left: 0.5rem; margin-top: 0.5rem;">
        <tr>
            <td align="left" style="width: 30%;">
                Kumar / Kumari.
            </td>

            <td align="left" style="width: 100%;" class="bb fb">
              {{strtoupper($student->name)}}
            </td>
        </tr>
    </table>

    <table style="width: 100%; padding-left: 0.5rem; margin-top: 0.5rem;">
        <tr>
            <td align="left" style="width: 30%;">
                <span>Son/Daughter of  </span>
            </td>

            <td align="left" style="width: 100%;" class="bb fb">
              {{$student->fname == null ? '' : strtoupper($student->fname)[0].' '}} {{$student->lname==null ? '': strtoupper($student->lname).' '}}
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
                <span>He/She is Studying in</span>
            </td>

            <td align="left" style="width: 75%;">
              <u class="fb">{{$cert->studying_in}}</u> <span style="margin-left: 1rem;">Standard. Him/Her Registration Number is: <span style="margin-left: 2rem;"><u class="fb">{{$student->id}}</u></span>     
            </td>
        </tr>
    </table>

    <table style="width: 100%; padding-left: 0.5rem; margin-top: 0.5rem;">
        <tr>
            <td>
                and Caste Details are mentioned below as per our School Records.
            </td>
        </tr>
    </table>

    <table class="fb" style="border: 2px solid black; width: 70%; margin-left: 5rem; padding-left: 0.4rem; padding-right: 0.4rem;padding-top: 0.4rem;">
        <tr>
            <td style="width: 20%; padding-bottom: 1rem;">
                Religion
            </td>

            <td>:</td>

            <td style="width: 70%; padding-bottom: 1rem;">
               <b> {{strtoupper($student->religion)}}</b>
            </td>
        </tr>
        <tr>
            <td style="width: 20%; padding-bottom: 1rem;">
                Caste
            </td>

            <td>:</td>

            <td style="width: 70%; padding-bottom: 1rem;">
                <b>{{$caste}}</b>
            </td>
        </tr>
        <tr>
            <td style="width: 20%; padding-bottom: 1rem;">
                Sub-Caste
            </td>

            <td>:</td>

            <td style="width: 70%; padding-bottom: 1rem;">
                <b>{{$subCaste}}</b>
            </td>
        </tr>
    </table>
    <table class="bb" style="width: 100%;">
        <tr>
            <td>&nbsp;</td>
        </tr>
    </table>

    <table style="width: 100%; padding-left: 0.5rem; margin-top: 14rem;  padding-bottom: 0.6rem;">
        <tr>
            <td align="left" style="padding-top: 0.5; padding-bottom: 1rem;">
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