@php
                        $totalDownPay = '0';
                        $totalComission = '0';
                    @endphp
                        @foreach ($package_info as $i=>$pkin)
                            <tr>
                                <td>{{ $i+1 }}</td>
                                <td>
                                    @foreach ($user as $usr)
                                        @if ($usr->id == $pkin->userid)
                                            {{ $usr->name }}
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($packageList as $pklst)
                                    @if ($pklst->packageId == $pkin->id)
                                            @foreach ($user as $usr)
                                                @if ($usr->id == $pklst->agentId)
                                                    {{ $usr->name }}
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    {{ $pkin->package_title }}
                                </td>
                                <td>
                                {{ $pkin->min_down_payment }}
                                @php
                                    $totalDownPay = $totalDownPay+$pkin->min_down_payment;
                                @endphp                           
                                </td>
                                
                            <td>
                                @foreach ($packageList as $pklst)
                                    @if ($pklst->packageId == $pkin->id)
                                        {{ $pklst->comission }}
                                        @php
                                            $totalComission = $totalComission+$pklst->comission;
                                        @endphp
                                    @endif
                                @endforeach
                            </td>
                            <td>
                            @foreach ($packageList as $pklst)
                                @if ($pklst->packageId == $pkin->id)
                                    {{ $pklst->created_at }}
                                @endif
                            @endforeach
                            </td>      
                            </tr>
                        @endforeach
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><b>Total</b></td>
                            <td><b>{{ $totalDownPay }}</b></td>
                            <td><b>{{ $totalComission }}</b></td>
                        </tr>