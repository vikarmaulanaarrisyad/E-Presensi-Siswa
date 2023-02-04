<table {{ $attributes->merge(['class' => 'table table-striped dt-responsive table-responsive nowrap']) }}>
    @isset($thead)
        <thead class="bg-primary">
            {{ $thead }}
        </thead>
    @endisset

    <tbody>
        {{ $slot }}
    </tbody>

    @isset($tfoot)
        <tfoot>
            {{ $tfoot }}
        </tfoot>
    @endisset
</table>
