<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Speelschema</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Speelschema</h1>
        <div class="grid grid-cols-1 gap-4">
            @php
                $teams = ['Team 1', 'Team 2', 'Team 3', 'Team 4', 'Team 5', 'Team 6', 'Team 7', 'Team 8', 'Team 9', 'Team 10'];
                $rounds = 9;
                $matchesPerRound = 5;
                $startTime = strtotime('12:00');
                $matchDuration = 15 * 60 * 2 + 10 * 60; // 15 minutes per half + 10 minutes break
                $breakBetweenMatches = 30 * 60; // 30 minutes
                $days = ['Vrijdag', 'Zaterdag', 'Zondag'];
            @endphp

            @for ($round = 1; $round <= $rounds; $round++)
                <div class="bg-white p-4 rounded shadow">
                    <h2 class="text-xl font-semibold mb-2">Speelronde {{ $round }}</h2>
                    @php
                        $currentDay = $days[($round - 1) % 3];
                        $currentTime = $startTime;
                    @endphp
                    <ul>
                        @for ($match = 0; $match < $matchesPerRound; $match++)
                            @php
                                $team1 = $teams[$match];
                                $team2 = $teams[($match + $round) % count($teams)];
                                $matchTime = date('H:i', $currentTime);
                                $currentTime += $matchDuration + $breakBetweenMatches;
                            @endphp
                            <li class="mb-2">
                                <span class="font-bold">{{ $currentDay }} {{ $matchTime }}</span> - {{ $team1 }} vs {{ $team2 }}
                            </li>
                        @endfor
                    </ul>
                </div>
            @endfor
        </div>
    </div>
</body>
</html>
