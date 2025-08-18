document.addEventListener('DOMContentLoaded', () => {
    // TUIが先に読み込まれているか確認
    if (!window.tui || !tui.Calendar) {
        console.error('TUI Calendar が読み込まれていません。CDNスクリプトの順序を確認してね。');
        return;
    }

    const cal = new tui.Calendar('#calendar', {
        defaultView: 'month',
        usageStatistics: false,
        isReadOnly: false,       // クリック追加しないなら true でもOK
        useDetailPopup: true,
        month: {
            startDayOfWeek: 0,
            isAlways6Weeks: true,
            visibleEventCount: 1,  // ← 1件だけ表示、残りは +n more
            // moreLayerSize: { width: 320, height: 360 } // 必要ならサイズ調整
        },
        calendars: [
            { id: 'school', name: 'School', backgroundColor: '#00a9ff' },
            { id: 'personal', name: 'Personal', backgroundColor: '#03bd9e' }
        ]
    });

    // 2) 月ラベル更新
    const $ = (id) => document.getElementById(id);
    const labelEl = $('calMonthLabel');
    const fmtMonth = (d) => `${d.getFullYear()}年 ${d.getMonth() + 1}月`;
    const updateMonthLabel = () => { if (labelEl) labelEl.textContent = fmtMonth(cal.getDate()); };
    updateMonthLabel();

    // 3) ナビゲーション
    $('calPrev')?.addEventListener('click', () => { cal.prev(); updateMonthLabel(); });
    $('calNext')?.addEventListener('click', () => { cal.next(); updateMonthLabel(); });
    $('calToday')?.addEventListener('click', () => { cal.today(); updateMonthLabel(); });

    // 4) 予定追加フォーム
    const form = $('calForm');
    const titleInput = $('evtTitle');
    const startInput = $('evtStart');
    const endInput = $('evtEnd');
    const allDayInput = $('evtAllDay');

    const decorateTitle = (raw) => {
        const t = (raw || '').trim();
        const lower = t.toLowerCase();
        if (!t) return t;
        if (lower.includes('課題') || lower.includes('レポート')) return `📝 ${t}`;
        if (lower.includes('授業') || lower.includes('講義')) return `📚 ${t}`;
        if (lower.includes('テスト') || lower.includes('試験')) return `🧪 ${t}`;
        return t;
    };

    const toISO = (dateStr, timeStr) => `${dateStr}T${timeStr}`;

    form?.addEventListener('submit', (e) => {
        e.preventDefault();

        let title = decorateTitle(titleInput.value);
        const startDate = startInput.value;             // 例: "2025-08-20"
        const endDate = endInput.value || startDate;  // 終日なら同日でもOK
        const isAllDay = !!allDayInput.checked;

        if (!title || !startDate) return;

        const startISO = isAllDay ? toISO(startDate, '00:00:00') : toISO(startDate, '09:00:00');
        const endISO = isAllDay ? toISO(endDate, '23:59:59') : toISO(endDate, '10:00:00');

        cal.createEvents([{
            id: String(Date.now()),
            calendarId: 'personal',
            title,
            start: startISO,
            end: endISO,
            category: isAllDay ? 'allday' : 'time',
            isAllDay
        }]);

        form.reset();
        allDayInput.checked = true; // 既定で終日に戻す
    });

    // 「+n more」やイベントクリック時の詳細ポップアップは
    // useDetailPopup: true で自動表示されます
});
