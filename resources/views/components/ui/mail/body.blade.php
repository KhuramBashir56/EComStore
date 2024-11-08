<x-layouts.mail>
    <table width="100%" style="max-width: 600px; margin: 0 auto;">
        <tr>
            <td>
                <x-ui.mail.header />
            </td>
        </tr>
        <tr>
            <td class="mail-body" style="padding: 10px 20px;">
                <table style="width: 100%;">
                    {{ $slot }}
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <x-ui.mail.footer />
            </td>
        </tr>
    </table>
</x-layouts.mail>
