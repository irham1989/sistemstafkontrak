<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html charset=UTF-8" />
    <title>Email</title>
</head>
<body>
<!--wrapper grey-->
<table align="center" bgcolor="#EAECED" border="0" cellpadding="0" cellspacing="0" width="100%">
    <tbody>

    <!--spacing-->
    <tr>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
    <!--First  table section with logo-->
    <tr>
        <td align="center" valign="top">
            <table width="600">
                <tbody>

                <tr>
                    <td align="center" valign="top">
                        <table bgcolor="#FFFFFF" border="0" cellpadding="0" cellspacing="0"
                               style="overflow:hidden!important; border-radius:3px" width="600">
                            <tbody>
                            <tr style="
    background: #acaaaa; line-height: 3.5">
                                <td align="Left" valign="top" style="width: 55px; padding:1px 5px 5px 32px;">
                                    <a href="https://ekedatanganv2.ikma.edu.my/media/logos/logo-ikkm.png"><img
                                            src="https://ekedatanganv2.ikma.edu.my/media/logos/logo-ikkm.png"
                                            title="IKMa Logo" width="100" height="60" style="padding-top: 10px !important;"></a>
                                </td>

                                <td align="Left" valign="top">
                                    <p style="font-family:Arial;font-style:normal;font-weight:bold;font-size:14px;text-align:right;color:#ffffff; padding:1px 32px 5px 4px;">
                                                    <span>{{ date('d F Y') }}
                                                    </span></p>

                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </td>
                </tr>

                </tbody>
            </table>

            <!--Separate table for header and content-->
            <table bgcolor="#FFFFFF" border="0" cellpadding="0" cellspacing="0" width="600">
                <tbody>
                <tr>
                    <td align="center">
                        <table width="85%">
                            <tbody>
                            <!--Content header Intro header-->
                            <tr>
                                <td align="left">
                                    <h2 style="font-family:Arial;font-style:normal;font-weight:bold;line-height:30px;font-size:24px;color:#333333;">
                                        Permohonan Cuti Anda {{ $approve == 1 ? 'Diluluskan' : 'Tidak Diluluskan' }}</h2>
                                </td>
                            </tr>

                            <!--para 1-->
                            <tr>
                                <td align="left"
                                    style="font-family:Arial;font-style:normal;font-weight:normal;line-height:22px;font-size:14px;color:#333333;">
                                    Di Bawah Adalah Maklumat Permohonan Anda: <br>
                                    Nama: {{ $user->name }}<br>
                                    E-Mel: {{ $user->email }}<br>
                                    Tarikh Mula Cuti: {{ date('d-m-Y', strtotime($entry->start_date)) }}<br>
                                    Tarikh Akhir Cuti: {{ date('d-m-Y', strtotime($entry->end_date)) }}<br>
                                    Bilangan Cuti: {{ $entry->days }} Hari<br>
                                    <br>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>

        </td> <!--first table section td ending-->


        <!--outer spacing-->
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
    <!--Second  table section with image-->
    <tr>
        <td align="center" valign="top">
            <!--Separate table for Copyright and company address-->
            <table border="0" cellpadding="0" cellspacing="0" width="580">
                <tbody>
                <!--Footer Company Name-->
                <tr>
                    <td align="left" valign="top">
                        <p style="margin-bottom:1em; padding:0!important;font-family:Arial;font-style:normal;font-weight:normal;font-size:14px;color:#999999;">
                        <span>© Hak Cipta Terpelihara © {{ date('Y') }} Institut Koperasi Malaysia (IKMa).
                        </span></p>
                    </td>
                </tr>
                <!--Footer address-->
                <tr>
                    <td>&nbsp;</td>
                </tr>

                </tbody>
            </table>
        </td>

    </tr>
    </tbody>
</table> <!-- - main tabel grey bg-->
</body>
</html>
