

    <div class="table-responsive" id="table-responsive">
        Test2

        @if(!empty($data))

        <table id="myTable">
            <thead>
            <tr>
            <tr>
                @for ($i = 0; $i <= 41; $i++)
                    <th>{{ $i }}</th>
                @endfor
            </tr>
            </tr>
            </thead>
            <tbody>
                <?php $uniqueValues[] = [] ?>
            @foreach($data as $row)
                @if(in_array($row[0], $uniqueValues) || $row[0] == 0)
                    <tr style="background-color: red;">
                @else
                    <tr>
                            <?php $uniqueValues[] = $row[0]; ?>
                        @endif
                        @for ($i = 0; $i <= 41; $i++)
                            @if($i==1)
                                <td><input type="text" name="column1[]" style="width: 100px;"
                                           value="{{ $row[$i] }}"/></td>
                            @else
                                <td><input type="text" name="column1[]" style="width: 40px;"
                                           value="{{ $row[$i] }}"/></td>
                            @endif
                        @endfor

                    </tr>
                    @endforeach
            </tbody>
        </table>
        @endif
    </div>


