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

        table{
            padding-top: 0.5; padding-bottom: 1rem;
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
                    BONAFIED CERTIFICATE
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
                <span >KUMAR / KUMARI. </span>
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
              {{$student->fname == null ? '' : strtoupper($student->fname)[0].'  '}} {{$student->lname==null ? '':strtoupper($student->lname)}}
            </td>
        </tr>
    </table>

    <table style="width: 100%; padding-left: 0.5rem; margin-top: 0.5rem;">
        <tr>
            <td>
                is a bonafied student of our school.
            </td>
        </tr>
    </table>

    <table style="width: 100%; padding-left: 0.5rem; margin-top: 0.5rem;">
        <tr>
            <td>
                <span>He/She is Studying in</span>
            </td>

            <td align="left" style="width: 75%;">
              <u class="fb">{{$bonfied->studying_in}}</u> <span style="margin-left: 1rem;">Standard. During the Academic Year  </span> <span style="margin-left: 1rem;"> <u class="fb">{{$bonfied->year}}</u> </span>
            </td>
        </tr>
    </table>

    <table style="width: 100%; padding-left: 0.5rem; margin-top: 0.5rem;">
        <tr>
            <td style="width: 50%;">
                <span>and Him/Her Registration Number is: </span>
            </td>

            <td align="left" style="width: 80%;">
              <u class="fb">{{$student->id}}</u>              
            </td>
        </tr>
    </table>

    <table style="width: 100%; padding-left: 0.5rem; margin-top: 1rem;  padding-bottom: 1rem;" class="bb">
        <tr>
            <td align="center">
                The above details are true and correct to the best of my knowledge.
            </td>
        </tr>
    </table>

    <table style="width: 100%; padding-left: 0.5rem; margin-top: 1rem;  padding-bottom: 0.6rem;">
        <tr>
            <td align="left">
                
            </td>
        </tr>
    </table>

    <table style="width: 100%; padding-left: 0.5rem; margin-top: 5rem;  padding-bottom: 0.6rem;">
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