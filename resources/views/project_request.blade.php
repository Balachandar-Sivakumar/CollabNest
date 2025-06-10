<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New Project Join Request</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f9fafb; padding: 20px;">
    <div style="max-width: 600px; margin: auto; background-color: #ffffff; padding: 25px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
        <h2 style="color: #4f46e5;">👋 Hello {{ Auth::user()->name }},</h2>

        <p style="font-size: 16px; color: #333333;">
            <strong>{{ $requester->name }}</strong> ({{ $requester->email }}) has requested to join your project: 
            <strong style="color: #111827;">"{{ $project->title }}"</strong>.
        </p>

        <hr style="margin: 20px 0; border: none; border-top: 1px solid #e5e7eb;">

        <p style="font-size: 16px; color: #4b5563;">
            You can take action on this request below:
        </p>

        <div style="margin: 20px 0;">
            <a href="{{ url('/project/request/' . $project->id . '/accept?user=' . $requester->id) }}"
               style="display: inline-block; margin-right: 10px; padding: 10px 20px; background-color: #10b981; color: #fff; text-decoration: none; border-radius: 6px;">
                ✅ Accept
            </a>
            <a href="{{ url('/project/request/' . $project->id . '/reject?user=' . $requester->id) }}"
               style="display: inline-block; padding: 10px 20px; background-color: #ef4444; color: #fff; text-decoration: none; border-radius: 6px;">
                ❌ Reject
            </a>
        </div>

        <p style="font-size: 14px; color: #9ca3af; margin-top: 30px; text-align: center;">
            — This is an automated message from your project portal. —
        </p>
    </div>
</body>
</html>
