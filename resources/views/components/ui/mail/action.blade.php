@props(['content'])
<tr>
    <td>
        <table width="100%">
            <tr>
                <td>
                    <p style="font-size: 16px; text-align: justify; margin-bottom: 10px;">
                        {{ $content }}
                    </p>
                </td>
            </tr>
            <tr>
                <td style="text-align: center;">
                    {{ $slot }}
                </td>
            </tr>
        </table>
    </td>
</tr>
