                    @php
                        $totalDue = '0';
                        $totalPrice = '0';
                    @endphp
                      
                        @foreach ($cart as $i=>$ct)
                            <tr>
                                <td>{{ $i+1 }}</td>
                                <td>
                                    @foreach ($user as $usr)
                                        @if ($usr->id == $ct->user_id)
                                            {{ $usr->name }}
                                        @endif
                                    @endforeach
                                </td>

                                <td>
                                    @foreach ($pkg as $pk)
                                        @if ($pk->id == $ct->package_id)
                                            @foreach ($user as $usr)
                                                @if ($pk->userid == $usr->id)
                                                    {{ $usr->name }}
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                </td>

                                <td>
                                    @foreach ($user as $usr)
                                        @if ($usr->id == $ct->agent_id)
                                            {{ $usr->name }}
                                        @endif
                                    @endforeach
                                </td>

                                <td>
                                    @foreach ($pkg as $pk)
                                        @if ($pk->id == $ct->package_id)
                                            {{ $pk->package_title }}
                                        @endif
                                    @endforeach
                                </td>

                                <td>
                                    {{ $ct->due }}
                                    @php
                                        $totalDue = $totalDue+$ct->due;
                                    @endphp
                                </td>

                                <td>
                                    {{ $ct->price }}
                                    @php
                                        $totalPrice = $totalPrice+$ct->price;
                                    @endphp
                                </td>

                                <td>
                                    {{ $ct->deal_date }}
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><b>Total</b></td>
                            <td><b>{{ $totalDue }}</b></td>
                            <td><b>{{ $totalPrice }}</b></td>
                            <td></td>
                        </tr>