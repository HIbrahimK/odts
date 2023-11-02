

    <div class="table-responsive" id="table-responsive">
        @if(!empty($data))

        <table id="myTable" class="table table-bordered table-striped dataTable dtr-inline">
            <thead>
            <tr>
                <th>Öğrenci No</th>
                <th>Öğrenci Adı</th>
                <th>Sınıfı</th>
                <th>Türkçe D</th>
                <th>Türkçe Y</th>
                <th>Türkçe Net</th>
                @for ($i = 7; $i <= 42; $i++)
                    <th>{{ $i }}</th>
                @endfor
            </tr>
            </thead>
            <tbody>

            @foreach ($data as $row)


                    @foreach ($row as $value)

                      <tr @if($value[0] == 0 ) style="background-color: red;" @endif>
                        @foreach($value as $deger)
                            <td > <input type="text" value="{{ $deger}}" style='width:100%'  ></td>
                         @endforeach
                        </tr>
                    @endforeach

@endforeach
</tbody>
</table>
@endif
</div>


