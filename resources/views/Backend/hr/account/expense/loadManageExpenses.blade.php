@php
                    $totalExp = '0';
                    $totalCost = '0';
                @endphp
                    @foreach ($services as $i=>$srv)
                        <tr>
                            <td>{{ $i+1 }}</td>
                            <td>{{ $srv->category }}</td>
                            <td>{{ $srv->sub_category }}</td>
                            <td>{{ $srv->title }}</td>
                            <td>{{ $srv->expense }}
                                    @php
                                        $totalExp = $totalExp+$srv->expense;
                                    @endphp
                            </td>
                            <td>{{ $srv->cost }}
                                    @php
                                        $totalCost = $totalCost+$srv->cost;
                                    @endphp
                            </td>
                            <td>{{ $srv->created }}</td>
                        </tr>
                    @endforeach
                    <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><b>Total</b></td>
                            <td><b>{{ $totalExp }}</b></td>
                            <td><b>{{ $totalCost }}</b></td>
                            <td></td>
                    </tr>