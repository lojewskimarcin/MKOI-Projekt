<div class="panel panel-default">
    <div class="panel-heading">@lang('results.range', array( 'max' => $max))</div>
    <div class="panel-body">
        <table class="table table-striped">
            <?php $paginator = ResultsController::paginateArray($results, 42);
            $from = ($paginator->getFrom() - 1) / 3;
            $to = ceil(($paginator->getFrom() - 1 + $paginator->count()) / 3);
            for ($i = $from; $i < $to; $i++) { ?>
            <tr>
                @if(isset($paginator[3*$i]))
                    <td class="text-center"><var>x<sub>{{3*$i+1}}</sub></var></td>
                    <td>{{$paginator[3*$i]}}</td>
                @else
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                @endif
                @if(isset($paginator[3*$i+1]))
                    <td class="text-center"><var>x<sub>{{3*$i+2}}</sub></var></td>
                    <td>{{$paginator[3*$i+1]}}</td>
                @else
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                @endif
                @if(isset($paginator[3*$i+2]))
                    <td class="text-center"><var>x<sub>{{3*$i+3}}</sub></var></td>
                    <td>{{$paginator[3*$i+2]}}</td>
                @else
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                @endif
            </tr>
            <?php } ?>
        </table>
        <div class="text-center">
            {{ $paginator->links() }}
        </div>
    </div>
</div>
