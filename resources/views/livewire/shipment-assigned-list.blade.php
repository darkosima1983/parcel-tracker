<div>
    <h3>Unassigned Shipments</h3>
    
    @if($shipments->isEmpty())
        <div class="alert alert-info">
            No unassigned shipments.
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-hover bg-white">
                <thead class="table-dark">
                    <tr>
                        <th>Title</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Price (€)</th>
                        <th>Assign Trucker</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($shipments as $shipment)
                        <tr>
                            <td>{{ $shipment->title }}</td>
                            <td>{{ $shipment->from_city }}, {{ $shipment->from_state }}</td>
                            <td>{{ $shipment->to_city }}, {{ $shipment->to_state }}</td>
                            <td>{{ $shipment->price }}</td>
                            <td>
                                <form method="POST" action="{{ route('shipments.assignUser', $shipment->id) }}">
                                    @csrf
                                    <select name="user_id" class="form-select form-select-sm mb-2" required>
                                        <option value="" selected disabled>-- Select Trucker --</option>
                                        @foreach(\App\Models\User::where('role', \App\Models\User::ROLE_TRUCKER)->get() as $trucker)
                                            <option value="{{ $trucker->id }}">{{ $trucker->name }}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="btn btn-sm btn-success">Assign</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>