@php
  
  $totalComission = '0';
  $totalPrice = '0';
  $totProfit = '0';

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
          <td id="total">
              {{ $ct->price }}
              @php
                  $totalPrice = $totalPrice+$ct->price;
              @endphp
          </td>
          <td id="commission">
              {{ $ct->comission }}%
              @php
                  $totalComission = $totalComission+$ct->comission;
              @endphp
          </td>
          <td id="result">
              @php
                  $totalPri = $ct->price * $ct->comission/100;
              @endphp
              {{ $totalPri }}
              @php
                  $totProfit = $totProfit + $totalPri;
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
      <td><b>{{ $totalPrice }}</b></td>
      <td><b>{{ $totalComission }}</b></td>
      <td><b>{{ $totProfit }}</b></td>
      <td></td>
  </tr>