<?php


namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Visitor;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class TrackVisitor
{
    public function handle(Request $request, Closure $next)
    {
        // Retrieve the session ID from the request
        $sessionId = $request->session()->getId();
        $now = Carbon::now();

        // Log the session ID for debugging purposes
        Log::info('Session ID: ' . $sessionId);

        // Find an existing visitor record with the same session ID
        $existingVisitor = Visitor::where('session_id', $sessionId)->first();

        if ($existingVisitor) {
            // Log the update action for debugging purposes
            Log::info('Updating existing visitor: ' . $sessionId);

            // Update the last activity timestamp for the existing visitor
            $existingVisitor->update(['last_activity' => $now]);
        } else {
            // Log the creation action for debugging purposes
            Log::info('Creating new visitor: ' . $sessionId);

            // Create a new visitor record
            Visitor::create([
                'session_id' => $sessionId,
                'user_agent' => $request->userAgent(),
                'last_activity' => $now,
            ]);
        }

        // Continue processing the request
        return $next($request);
    }
}
