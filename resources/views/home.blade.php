@extends('layouts.app')

@section('content')
<style>
    .welcome-container {
        display: flex;
        justify-content: space-between;
    }

    .clock-container {
        text-align: right;
    }

    .calendar {
          max-width: 90%;
          margin: 0 auto;
          text-align: center;
          margin-top: 20px; /* Adjust as needed */
        }

        .header {
          display: flex;
          align-items: center;
          justify-content: space-between;
        }

        .days {
          display: grid;
          grid-template-columns: repeat(7, 1fr);
          gap: 5px;
        }

        .day {
          padding: 10px;
          border: 1px solid #ddd;
        }

        .event {
          background-color: lightblue;
        }

        .animated-greeting {
            animation: fadeIn 2s ease-in-out;
            color: #ff6347; /* Tomato color */
        }

        .birthday-heading {
            animation: bounceIn 1s ease-in-out;
            color: #ff4500; /* OrangeRed color */
        }

        .birthday-list {
            list-style-type: none;
            padding: 0;
        }

        .birthday-item {
            animation: slideIn 0.5s ease-in-out;
            padding: 1rem;
            margin: 0.5rem 0;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: space-between;

            /* Light mode defaults */
            background-color: #f7fafc;
            border: 1px solid #e2e8f0;
            color: #2d3748;
        }

        .birthday-item:hover {
            transform: translateX(5px);
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .birthday-item-content {
            flex: 1;
        }

        .birthday-item-date {
            font-weight: 500;
            margin-left: 1rem;
            color: #718096; /* Subtle text color for dates */
        }

        /* Dark mode styles */
        @media (prefers-color-scheme: dark) {
            .birthday-item {
                background-color: #2d3748;
                border-color: #4a5568;
                color: #e2e8f0;
            }

            .birthday-item:hover {
                background-color: #353f4f;
                box-shadow: 0 2px 4px rgba(0,0,0,0.2);
            }

            .birthday-item-date {
                color: #a0aec0; /* Lighter color for dates in dark mode */
            }
        }

        /* Animation for new items */
        .birthday-item {
            animation: slideIn 0.5s ease-in-out;
            animation-fill-mode: both;
        }

        .birthday-item:nth-child(2) {
            animation-delay: 0.1s;
        }

        .birthday-item:nth-child(3) {
            animation-delay: 0.2s;
        }

        /* Accessibility - disable animations if user prefers reduced motion */
        @media (prefers-reduced-motion: reduce) {
            .birthday-item {
                animation: none;
            }
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .birthday-item {
                padding: 0.75rem;
                font-size: 0.95rem;
            }

            .birthday-item-date {
                font-size: 0.85rem;
            }
        }

        @media (max-width: 576px) {
            .birthday-item {
                padding: 0.5rem;
                font-size: 0.9rem;
                flex-direction: column;
                align-items: flex-start;
            }

            .birthday-item-date {
                margin-left: 0;
                margin-top: 0.25rem;
                font-size: 0.8rem;
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes bounceIn {
            from {
                transform: scale(0.5);
                opacity: 0;
            }
            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        @keyframes slideIn {
            from {
                transform: translateX(-100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .welcome-heading {
                font-size: 28px;
            }
            .welcome-subheading {
                font-size: 24px;
            }
            .clock-container {
                text-align: center;
                margin-top: 20px;
            }
        }

        /* Enhanced card styles */
        .card {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        /* Improved list styles */
        .custom-list {
            list-style-type: none;
            padding-left: 0;
        }
        .custom-list li {
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }
        .custom-list li:last-child {
            border-bottom: none;
        }

        /* Enhanced icons */
        .card-icon {
            font-size: 2.5rem;
            margin-right: 15px;
        }

    /* Add responsive styles for smaller screens */
    @media (max-width: 576px) {
        .card-icon {
            font-size: 2rem;
        }
        .card-title {
            font-size: 0.9rem;
        }
        .card-text {
            font-size: 1.5rem;
        }
    }

    /* Professional enhancements */
    body {
        background-color: #f8f9fa;
    }

    .card {
        border: none;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }

    .card-header {
        border-bottom: none;
        padding: 1.25rem 1.5rem;
        background-color: #ffffff;
        border-radius: 8px 8px 0 0;
    }

    .card-body {
        padding: 1.5rem;
    }

    .card-icon {
        font-size: 2rem;
        margin-right: 1rem;
        opacity: 0.8;
    }

    .welcome-message {
        background: linear-gradient(135deg, #6B73FF 0%, #000DFF 100%);
        color: #ffffff;
    }

    .welcome-heading {
        font-weight: 600;
    }

    .welcome-subheading {
        opacity: 0.8;
    }

    .clock-container {
        background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
        color: #ffffff;
    }

    #clock {
        font-weight: 700;
    }

    .custom-list li {
        padding: 0.75rem 0;
        border-bottom: 1px solid #e9ecef;
    }

    .custom-list li:last-child {
        border-bottom: none;
    }

    .birthday-item, .holiday-item {
        background-color: #f1f3f5;
        border-radius: 6px;
        padding: 0.75rem;
        margin-bottom: 0.5rem;
    }

    /* Dashboard cards */
    .dashboard-card {
        border-radius: 8px;
        overflow: hidden;
    }

    .dashboard-card .card-body {
        padding: 1.25rem;
    }

    .dashboard-card .card-title {
        font-size: 0.9rem;
        font-weight: 600;
        margin-bottom: 0.25rem;
    }

    .dashboard-card .card-text {
        font-size: 1.5rem;
        font-weight: 700;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .card-icon {
            font-size: 1.5rem;
        }

        .dashboard-card .card-title {
            font-size: 0.8rem;
        }

        .dashboard-card .card-text {
            font-size: 1.2rem;
        }
    }

    /* Enhanced responsive styles */
    @media (max-width: 1200px) {
        .dashboard-card .card-title {
            font-size: 0.85rem;
        }
        .dashboard-card .card-text {
            font-size: 1.3rem;
        }
    }

    @media (max-width: 992px) {
        .col-lg-6 {
            margin-bottom: 1.5rem;
        }
    }

    @media (max-width: 768px) {
        .welcome-heading {
            font-size: 1.5rem;
        }
        .welcome-subheading {
            font-size: 1.2rem;
        }
        #clock {
            font-size: 2rem;
        }
        .card-icon {
            font-size: 1.3rem;
        }
        .dashboard-card .card-title {
            font-size: 0.8rem;
        }
        .dashboard-card .card-text {
            font-size: 1.1rem;
        }
    }

    @media (max-width: 576px) {
        .container-fluid {
            padding-left: 10px;
            padding-right: 10px;
        }
        .card-body {
            padding: 1rem;
        }
        .welcome-heading {
            font-size: 1.3rem;
        }
        .welcome-subheading {
            font-size: 1rem;
        }
        #clock {
            font-size: 1.5rem;
        }
        .dashboard-card .card-title {
            font-size: 0.75rem;
        }
        .dashboard-card .card-text {
            font-size: 1rem;
        }
    }

    /* Professional enhancements */
    .card {
        transition: all 0.3s ease;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    .welcome-message, .clock-container {
        background-size: 200% 200%;
        animation: gradientAnimation 5s ease infinite;
    }
    @keyframes gradientAnimation {
        0% {background-position: 0% 50%;}
        50% {background-position: 100% 50%;}
        100% {background-position: 0% 50%;}
    }
    .animated-text {
        display: inline-block;
        animation: textAnimation 2s ease-in-out infinite;
    }
    @keyframes textAnimation {
        0%, 100% {transform: translateY(0);}
        50% {transform: translateY(-5px);}
    }
    .custom-list li {
        transition: all 0.3s ease;
    }
    .custom-list li:hover {
        background-color: #f8f9fa;
        padding-left: 10px;
    }
    .dashboard-card {
        overflow: hidden;
    }
    .dashboard-card::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: rgba(255,255,255,0.1);
        transform: rotate(30deg);
        transition: all 0.5s ease;
    }
    .dashboard-card:hover::before {
        transform: rotate(30deg) translate(-10%, -10%);
    }

    /* Enhanced Analytics Dashboard Styles */
    .analytics-dashboard {
        background: linear-gradient(to bottom right, #f8f9fa, #ffffff);
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
    }

    .analytics-card {
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.08);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        height: 100%;
        border: none;
    }

    .analytics-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .analytics-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: #2d3748;
        padding: 0.75rem 1rem;
        border-bottom: 1px solid #e9ecef;
        margin: 0;
        display: flex;
        align-items: center;
        background: #f8f9fa;
        border-radius: 12px 12px 0 0;
    }

    .analytics-icon {
        font-size: 1.2rem;
        margin-right: 10px;
        opacity: 0.8;
    }

    .analytics-content {
        padding: 1.25rem;
    }

    .analytics-metric {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
    }

    .analytics-label {
        font-size: 0.9rem;
        color: #6c757d;
        font-weight: 500;
    }

    .analytics-number {
        font-size: 1.5rem;
        font-weight: 700;
        background: linear-gradient(45deg, #2193b0, #6dd5ed);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .chart-container {
        position: relative;
        height: 150px;
        margin-top: 1rem;
        padding: 10px;
        background: #ffffff;
        border-radius: 8px;
        box-shadow: inset 0 0 10px rgba(0,0,0,0.05);
    }

    .trend-info {
        text-align: center;
        margin-top: 1rem;
        padding: 0.5rem;
        background: #f8f9fa;
        border-radius: 6px;
        font-size: 0.85rem;
        color: #6c757d;
    }

    /* Section Headers */
    .analytics-section {
        margin-bottom: 2rem;
    }

    .section-header {
        background: linear-gradient(45deg, #4b6cb7, #182848);
        color: white;
        padding: 1rem 1.5rem;
        border-radius: 10px;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    .section-header i {
        margin-right: 10px;
        font-size: 1.5rem;
    }

    .section-header h5 {
        margin: 0;
        font-weight: 600;
    }

    /* Dark Mode Support */
    @media (prefers-color-scheme: dark) {
        .analytics-dashboard {
            background: linear-gradient(to bottom right, #1a202c, #2d3748);
        }

        .analytics-card {
            background: #2d3748;
        }

        .analytics-title {
            background: #1a202c;
            color: #e2e8f0;
            border-bottom-color: #4a5568;
        }

        .analytics-label {
            color: #a0aec0;
        }

        .analytics-number {
            background: linear-gradient(45deg, #60a5fa, #93c5fd);
            -webkit-background-clip: text;
        }

        .chart-container {
            background: #1a202c;
            box-shadow: inset 0 0 10px rgba(0,0,0,0.2);
        }

        .trend-info {
            background: #1a202c;
            color: #a0aec0;
        }
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .analytics-dashboard {
            padding: 15px;
        }

        .analytics-title {
            font-size: 1rem;
        }

        .analytics-number {
            font-size: 1.25rem;
        }

        .chart-container {
            height: 120px;
        }

        .section-header {
            padding: 0.75rem 1rem;
        }
    }

    /* Enhanced Card Design */
    .card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 8px 16px rgba(0,0,0,0.1);
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        overflow: hidden;
    }

    .card:hover {
        transform: translateY(-5px) scale(1.01);
        box-shadow: 0 12px 24px rgba(0,0,0,0.15);
    }

    /* Enhanced Welcome Message */
    .welcome-message {
        background: linear-gradient(135deg, #6B73FF 0%, #000DFF 100%);
        border-radius: 15px;
        padding: 2rem;
    }

    .welcome-heading {
        font-size: 2.5rem;
        font-weight: 700;
        color: #ffffff;
        margin-bottom: 1rem;
    }

    /* Enhanced Clock Container */
    .clock-container {
        background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
        border-radius: 15px;
        padding: 2rem;
    }

    #clock {
        font-size: 3.5rem;
        font-weight: 700;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
        margin: 1rem 0;
    }

    /* Enhanced Dashboard Cards */
    .dashboard-card {
        position: relative;
        overflow: hidden;
    }

    .dashboard-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(45deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 100%);
        transform: translateX(-100%);
        transition: transform 0.6s;
    }

    .dashboard-card:hover::before {
        transform: translateX(100%);
    }

    .card-icon {
        font-size: 2.5rem;
        margin-right: 1rem;
        opacity: 0.9;
        transition: transform 0.3s;
    }

    .dashboard-card:hover .card-icon {
        transform: scale(1.1) rotate(5deg);
    }

    /* Enhanced Analytics Dashboard */
    .analytics-dashboard {
        background: linear-gradient(to bottom, #f8f9fa, #ffffff);
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    }

    .analytics-card {
        border-radius: 15px;
        background: #ffffff;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }

    .analytics-number {
        font-size: 1.5rem;
        font-weight: 700;
        background: linear-gradient(45deg, #2193b0, #6dd5ed);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* Enhanced Progress Bars */
    .progress {
        height: 8px;
        border-radius: 4px;
        background: rgba(0,0,0,0.05);
        overflow: hidden;
    }

    .progress-bar {
        transition: width 1s ease-in-out;
        background: linear-gradient(45deg, #2193b0, #6dd5ed);
    }

    /* Enhanced Birthday Section */
    .birthday-item {
        background: linear-gradient(45deg, #fff, #f8f9fa);
        border-left: 4px solid #6B73FF;
        padding: 1rem 1.5rem;
        margin-bottom: 1rem;
        border-radius: 10px;
        transition: all 0.3s ease;
    }

    .birthday-item:hover {
        transform: translateX(10px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    /* Enhanced Alerts */
    .alert {
        border: none;
        border-radius: 10px;
        padding: 1rem 1.5rem;
        background: linear-gradient(45deg, #4CAF50, #45a049);
        color: white;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .alert-info {
        background: linear-gradient(45deg, #2196F3, #1976D2);
    }

    /* Enhanced Charts */
    .chart-container {
        position: relative;
        height: 120px;
        margin-top: 1.5rem;
    }

    /* Responsive Enhancements */
    @media (max-width: 768px) {
        .welcome-heading {
            font-size: 2rem;
        }

        #clock {
            font-size: 2.5rem;
        }

        .analytics-number {
            font-size: 1.2rem;
        }

        .chart-container {
            height: 100px;
        }
    }

    /* Dark Mode Support */
    @media (prefers-color-scheme: dark) {
        body {
            background: #1a1a1a;
        }

        .card {
            background: #2d2d2d;
            color: #ffffff;
        }

        .analytics-dashboard {
            background: linear-gradient(to bottom, #2d2d2d, #1a1a1a);
        }

        .analytics-card {
            background: #2d2d2d;
        }

        .birthday-item {
            background: linear-gradient(45deg, #2d2d2d, #252525);
            border-left-color: #6B73FF;
        }
    }

    /* Birthday Modal Styles - Updated for Landscape */
    .modal-dialog {
        max-width: 900px; /* Wider modal for landscape */
    }

    .modal-content {
        border: none;
        border-radius: 15px;
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
        overflow: hidden;
    }

    .celebrant-profile-card {
        display: flex;
        flex-direction: row; /* Change to row for landscape */
        gap: 2rem;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        background: rgba(255, 255, 255, 0.95);
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .celebrant-left-section {
        flex: 0 0 250px; /* Fixed width for left section */
        text-align: center;
    }

    .celebrant-right-section {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .celebrant-avatar-large {
        width: 180px;
        height: 180px;
        margin: 0 auto 1rem;
        position: relative;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
    }

    .celebrant-details {
        background: linear-gradient(145deg, #ffffff, #f8f9fa);
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
        margin-top: 1rem;
    }

    .info-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.5rem;
        background: rgba(255, 255, 255, 0.5);
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .info-item:hover {
        background: rgba(255, 255, 255, 0.8);
        transform: translateX(5px);
    }

    .birthday-message-section {
        margin-top: 1.5rem;
        padding: 1.5rem;
        background: linear-gradient(45deg, rgba(78, 205, 196, 0.1), rgba(69, 183, 209, 0.1));
        border-radius: 12px;
        text-align: left;
    }

    /* Update the modal content structure */
    @media (max-width: 768px) {
        .modal-dialog {
            max-width: 95%;
            margin: 1rem auto;
        }

        .celebrant-profile-card {
            flex-direction: column;
            gap: 1rem;
        }

        .celebrant-left-section {
            flex: 0 0 auto;
        }

        .celebrant-avatar-large {
            width: 120px;
            height: 120px;
        }

        .info-grid {
            grid-template-columns: 1fr;
        }
    }

    /* Dark mode support */
    @media (prefers-color-scheme: dark) {
        .modal-content {
            background: linear-gradient(135deg, #2d3748 0%, #1a202c 100%);
        }
        .celebrant-card {
            background: rgba(45, 55, 72, 0.9);
        }
        .celebrant-name {
            color: #e2e8f0;
        }
        .department-name {
            color: #a0aec0;
        }
        .birthday-message {
            color: #e2e8f0;
        }
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .modal-dialog {
            margin: 1rem;
        }
        .celebrant-card {
            padding: 1rem;
        }
        .celebrant-name {
            font-size: 1.25rem;
        }
        .birthday-message .lead {
            font-size: 1rem;
        }
    }

    /* Enhanced Modal Styles */
    #birthdayModal .modal-content {
        border: none;
        border-radius: 20px;
        background: linear-gradient(145deg, #ffffff, #f8f9fa);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    #birthdayModal .modal-header {
        padding: 1.5rem 1.5rem 0.5rem;
    }

    .birthday-title {
        font-size: 1.8rem;
        font-weight: 600;
        background: linear-gradient(45deg, #FF6B6B, #4ECDC4);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: titlePulse 2s infinite;
    }

    .close-button {
        position: absolute;
        right: 1.5rem;
        top: 1.5rem;
        background: none;
        border: none;
        color: #6c757d;
        font-size: 1.2rem;
        opacity: 0.7;
        transition: all 0.3s ease;
        padding: 0.5rem;
        border-radius: 50%;
        width: 35px;
        height: 35px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .close-button:hover {
        opacity: 1;
        background-color: rgba(108, 117, 125, 0.1);
        transform: rotate(90deg);
    }

    .celebrant-card {
        background: rgba(255, 255, 255, 0.9);
        border-radius: 15px;
        padding: 1.25rem;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 1rem;
        animation: slideIn 0.5s ease-out;
    }

    .celebrant-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
    }

    .celebrant-avatar {
        width: 50px;
        height: 50px;
        background: linear-gradient(45deg, #4ECDC4, #45B7D1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
    }

    .celebrant-info {
        flex: 1;
        text-align: left;
    }

    .celebrant-name {
        color: #2d3748;
        margin: 0;
        font-size: 1.1rem;
    }

    .department-name {
        color: #718096;
        font-size: 0.9rem;
    }

    .animated-cake {
        color: #FF6B6B;
        animation: bounce 2s infinite;
    }

    .modal-footer {
        justify-content: center;
        padding: 1.5rem;
    }

    .modal-footer .btn {
        padding: 0.5rem 1.5rem;
        border-radius: 25px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-primary {
        background: linear-gradient(45deg, #4ECDC4, #45B7D1);
        border: none;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(78, 205, 196, 0.4);
    }

    .btn-secondary {
        background: #718096;
        border: none;
    }

    .btn-secondary:hover {
        background: #4a5568;
    }

    @keyframes titlePulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.8; }
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Dark mode support */
    @media (prefers-color-scheme: dark) {
        #birthdayModal .modal-content {
            background: linear-gradient(145deg, #2d3748, #1a202c);
        }

        .celebrant-card {
            background: rgba(45, 55, 72, 0.9);
        }

        .celebrant-name {
            color: #e2e8f0;
        }

        .department-name {
            color: #a0aec0;
        }

        .close-button {
            color: #e2e8f0;
        }

        .close-button:hover {
            background-color: rgba(226, 232, 240, 0.1);
        }
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .birthday-title {
            font-size: 1.5rem;
        }

        .celebrant-card {
            padding: 1rem;
        }

        .celebrant-avatar {
            width: 40px;
            height: 40px;
        }

        .celebrant-name {
            font-size: 1rem;
        }

        .modal-footer .btn {
            padding: 0.4rem 1.2rem;
            font-size: 0.9rem;
        }
    }

    /* Add these styles for balloon canvas positioning */
    #balloon-canvas {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 1040; /* Just below modal backdrop (1050) */
        pointer-events: none; /* Initially no pointer events */
    }

    /* Adjust modal styles to work with balloon backdrop */
    #birthdayModal .modal-dialog {
        position: relative;
        z-index: 1060; /* Above the balloon canvas */
    }

    #birthdayModal .modal-content {
        background: rgba(255, 255, 255, 0.95); /* Slightly transparent background */
        backdrop-filter: blur(5px); /* Blur effect for background */
    }

    /* Dark mode adjustment */
    @media (prefers-color-scheme: dark) {
        #birthdayModal .modal-content {
            background: rgba(45, 55, 72, 0.95);
        }
    }

    /* Add these styles */
    .celebrant-profile-card {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 15px;
        padding: 2rem;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }

    .celebrant-avatar-large {
        width: 150px;
        height: 150px;
        margin: 0 auto;
        position: relative;
    }

    .celebrant-avatar-large img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border: 4px solid #fff;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .default-avatar {
        width: 100%;
        height: 100%;
        background: linear-gradient(45deg, #4ECDC4, #45B7D1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 4rem;
        color: white;
    }

    .celebrant-details {
        padding: 1rem;
    }

    .celebrant-name {
        font-size: 1.8rem;
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 1.5rem;
        background: linear-gradient(45deg, #FF6B6B, #FF8E53);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .info-grid {
        display: grid;
        gap: 1rem;
    }

    .info-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-size: 1rem;
    }

    .info-item i {
        width: 24px;
        height: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(45deg, #4ECDC4, #45B7D1);
        color: white;
        border-radius: 50%;
        font-size: 0.8rem;
    }

    .birthday-message-section {
        margin-top: 2rem;
        padding: 1.5rem;
        background: linear-gradient(45deg, rgba(78, 205, 196, 0.1), rgba(69, 183, 209, 0.1));
        border-radius: 10px;
    }

    .birthday-wish {
        font-size: 1.1rem;
        color: #4a5568;
        line-height: 1.6;
    }

    .celebrant-divider {
        border-color: rgba(0, 0, 0, 0.1);
        margin: 2rem 0;
    }

    .birthday-cake-animation {
        margin-top: 1rem;
        font-size: 2.5rem;
    }

    /* Dark mode styles */
    @media (prefers-color-scheme: dark) {
        .celebrant-profile-card {
            background: rgba(45, 55, 72, 0.95);
        }

        .celebrant-name {
            background: linear-gradient(45deg, #FF6B6B, #FF8E53);
            -webkit-background-clip: text;
        }

        .info-item {
            color: #e2e8f0;
        }

        .birthday-wish {
            color: #e2e8f0;
        }

        .birthday-message-section {
            background: linear-gradient(45deg, rgba(78, 205, 196, 0.05), rgba(69, 183, 209, 0.05));
        }
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .celebrant-profile-card {
            padding: 1rem;
        }

        .celebrant-avatar-large {
            width: 120px;
            height: 120px;
        }

        .celebrant-name {
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .info-item {
            font-size: 0.9rem;
        }

        .birthday-wish {
            font-size: 1rem;
        }
    }

    /* Add styles for the MHR Family message */
    .mhr-family-message {
        margin-top: 1rem;
        font-size: 1.2rem;
        font-weight: 600;
        color: #FF6B6B;
        text-transform: uppercase;
        letter-spacing: 2px;
        animation: glowText 2s ease-in-out infinite;
    }

    @keyframes glowText {
        0%, 100% {
            text-shadow: 0 0 5px rgba(255, 107, 107, 0.3);
        }
        50% {
            text-shadow: 0 0 15px rgba(255, 107, 107, 0.5);
        }
    }

    /* Add some CSS for the checkbox styling */
    .dont-show-again {
        font-size: 0.9rem;
        color: #6c757d;
    }

    .custom-checkbox .custom-control-input:checked ~ .custom-control-label::before {
        background-color: #6c757d;
        border-color: #6c757d;
    }

    .modal-footer {
        border-top: 1px solid #dee2e6;
        padding: 1rem;
    }

    /* Dark mode support */
    @media (prefers-color-scheme: dark) {
        .dont-show-again {
            color: #adb5bd;
        }
        
        .custom-checkbox .custom-control-input:checked ~ .custom-control-label::before {
            background-color: #adb5bd;
            border-color: #adb5bd;
        }
    }

    /* Add styles for the confirmation message */
    .alert-info {
        background-color: #cce5ff;
        border-color: #b8daff;
        color: #004085;
        padding: 0.5rem 1rem;
        margin-top: 0.5rem;
        border-radius: 0.25rem;
        font-size: 0.875rem;
        animation: fadeIn 0.3s ease-in-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .dont-show-again {
        display: flex;
        flex-direction: column;
    }

    .custom-control-input:checked ~ .custom-control-label::before {
        border-color: #007bff;
        background-color: #007bff;
    }

    .custom-checkbox .custom-control-label {
        cursor: pointer;
    }

    .custom-checkbox .custom-control-label:hover {
        color: #007bff;
    }
</style>
<div class="container-fluid">
    <!-- Signature Reminder Alert - Moved to top and enhanced styling -->
    @if(Auth::user()->hasRole('Employee'))
        @if(!$employees->first()->signature)
            <div class="col-md-12 mb-4">
                <div class="alert alert-warning alert-dismissible fade show" role="alert" 
                     style="border-left: 5px solid #ffc107; background-color: #fff3cd; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-exclamation-triangle fa-2x mr-3" style="color: #ffc107;"></i>
                        <div>
                            <h5 class="alert-heading mb-1">Action Required</h5>
                            <p class="mb-0">
                                <strong>Notice:</strong> Please add your signature to your employee profile before applying for leave. 
                                <a href="{{ url('/my-profile') }}" class="alert-link">Update your profile here</a>.
                            </p>
                        </div>
                    </div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        @endif
    @endif

    @if($todaysBirthdays->where('employee_status', 'Active')->isNotEmpty())
        <!-- Birthday Modal -->
        @foreach($todaysBirthdays->where('employee_status', 'Active') as $index => $employee)
        <div class="modal fade" id="birthdayModal{{ $index }}" tabindex="-1" role="dialog" aria-labelledby="birthdayModalLabel{{ $index }}" aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <h4 class="modal-title w-100 text-center" id="birthdayModalLabel{{ $index }}">
                            <span class="birthday-title">
                                <i class="fas fa-birthday-cake animated-cake mr-2"></i>
                                Today's Birthday Celebration!
                            </span>
                        </h4>
                        <button type="button" class="close-button" data-dismiss="modal" aria-label="Close">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="celebrant-profile-card">
                            <div class="celebrant-left-section">
                                <div class="celebrant-avatar-large">
                                    @if($employee->profile)
                                        <img src="{{ asset('storage/' . $employee->profile) }}" 
                                             alt="{{ $employee->first_name }}" 
                                             class="img-fluid rounded">
                                    @else
                                        <div class="default-avatar">
                                            <i class="fas fa-user-circle fa-5x"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="birthday-cake-animation">
                                    <i class="fas fa-birthday-cake animated-cake fa-3x"></i>
                                    <div class="mhr-family-message mt-3">
                                        From MHR Family
                                    </div>
                                </div>
                            </div>
                            
                            <div class="celebrant-right-section">
                                <div class="celebrant-details">
                                    <h3 class="celebrant-name mb-3">
                                        {{ $employee->first_name }} {{ $employee->last_name }}
                                    </h3>
                                    
                                    <div class="info-grid">
                                        <div class="info-item">
                                            <i class="fas fa-building"></i>
                                            <span>{{ $employee->department->name ?? 'N/A' }}</span>
                                        </div>
                                        <div class="info-item">
                                            <i class="fas fa-user-tie"></i>
                                            <span>{{ $employee->position->name ?? 'N/A' }}</span>
                                        </div>
                                        <div class="info-item">
                                            <i class="fas fa-calendar-day"></i>
                                            <span>{{ \Carbon\Carbon::parse($employee->birth_date)->format('F d') }}</span>
                                        </div>
                                    </div>
                                    
                                    <div class="birthday-message-section">
                                        <p class="birthday-wish">
                                            Wishing you a fantastic birthday filled with joy, success, and wonderful moments! 
                                            May this special day bring you everything you wish for and more. 
                                            Happy Birthday! 🎈🎉
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <div class="dont-show-again">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input dont-show-checkbox" 
                                       id="dontShowAgain{{ $index }}" 
                                       data-employee-id="{{ $employee->id }}"
                                       data-birthday-year="{{ date('Y') }}">
                                <label class="custom-control-label" for="dontShowAgain{{ $index }}">
                                    Don't show again
                                </label>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    @endif

    <div class="row">
        <!-- Welcome section -->
        <div class="col-lg-6 mb-4">
            @auth
            <div class="welcome-message p-4 rounded shadow-sm">
                <h2 class="welcome-heading mb-2">Welcome, <span class="animated-text">{{ auth()->user()->first_name }}</span></h2>
                <h4 class="welcome-subheading">{{ auth()->user()->last_name }}</h4>
                <div class="d-flex justify-content-between align-items-center position-relative" style="height: 60px;">
                    <span id="greeting" class="mt-3 mb-0 text-white-50" style="font-size: 1.2rem;"></span>
                    <span id="greeting-emoji" class="mt-3 mb-0 text-white-50" style="font-size: 8rem; position: absolute; right: 50px;top: 1px; transform: translate(50%, -50%); margin-right: 10px;"></span>
                </div>
                <script>
                    function updateGreeting() {
                        const now = new Date();
                        const hours = now.getHours();
                        let greeting;
                        let emoji;

                        if (hours < 12) {
                            greeting = "Good Morning";
                            emoji = "☀️";
                        } else if (hours < 18) {
                            greeting = "Good Afternoon";
                            emoji = "🌤️";
                        } else {
                            greeting = "Good Evening";
                            emoji = "🌙";
                        }

                        document.getElementById('greeting').textContent = greeting;
                        document.getElementById('greeting-emoji').textContent = emoji;
                    }

                    updateGreeting(); // Call the function to set the greeting
                </script>
            </div>
            @endauth
        </div>
        <!-- Clock section -->
        <div class="col-lg-6 mb-4">
            <div class="clock-container p-4 rounded shadow-sm">
                <div id="date" class="mb-2 opacity-75"></div>
                <h1 id="clock" class="display-4"></h1>
                <p class="mt-3 mb-0 text-white-50">Philippine Standard Time</p>
            </div>
        </div>
    </div>

    <!-- Posts section -->
    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center bg-primary text-white">
                    <i class="fas fa-bullhorn card-icon mr-2"></i>
                    <h5 class="mb-0">Today's Announcements</h5>
                </div>
                <div class="card-body">
                    @if ($todayPosts && $todayPosts->count() > 0)
                        <ul class="custom-list">
                            @foreach ($todayPosts as $post)
                                <li class="mb-3">
                                    <h6 class="mb-1">
                                        <a href="{{ route('posts.showById', $post->id) }}" class="text-decoration-none text-primary">
                                            {{ $post->title }}
                                        </a>
                                    </h6>
                                    <p class="text-muted mb-1">{{ Str::limit($post->body, 100) }}</p>
                                    <small class="text-muted">Posted {{ $post->created_at->diffForHumans() }}</small>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-muted">No announcements for today</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Employee's Leave Count section -->
        <div class="col-lg-6 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center bg-success text-white">
                    <i class="fas fa-calendar-check card-icon mr-2"></i>
                    <h5 class="mb-0">Standard Leave Allocation</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <h6 class="text-muted">Sick Leave</h6>
                            <h2 class="mb-0">7 <small>days</small></h2>
                        </div>
                        <div class="col-md-4 mb-3">
                            <h6 class="text-muted">Vacation Leave</h6>
                            <h2 class="mb-0">5 <small>days</small></h2>
                        </div>
                        <div class="col-md-4 mb-3">
                            <h6 class="text-muted">Emergency Leave</h6>
                            <h2 class="mb-0">3 <small>days</small></h2>
                        </div>
                    </div>
                    <p class="text-muted mt-3 mb-0">
                        <i class="fas fa-info-circle mr-1"></i>
                        Leave allocations are reset annually on January 1st.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Remaining Leave Balance section -->
    @if(auth()->user()->hasRole('Employee'))
        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="fas fa-calendar-alt mr-2"></i>Your Remaining Leave Balance</h5>
                    </div>
                    <div class="card-body">
                        @if ($leaveDetails)
                            @foreach(['sick_leave', 'vacation_leave', 'emergency_leave'] as $leaveType)
                                <p>
                                    <strong>{{ ucfirst(str_replace('_', ' ', $leaveType)) }}:</strong>
                                    {{ $leaveDetails[$leaveType] }} Hours
                                    ({{ number_format($leaveDetails[$leaveType] / 24, 2) }} Days)
                                </p>
                            @endforeach
                        @else
                            <p class="text-muted">No leave balance available</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Birthdays section -->
    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-birthday-cake mr-2"></i>Birthdays in {{ $currentMonthNameBirthdays }}</h5>
                </div>
                <div class="card-body">
                    @if($greeting)
                        <h3 class="animated-greeting">{{ $greeting }}</h3>
                    @endif

                    @if($todaysBirthdays->where('employee_status', 'Active')->isNotEmpty())
                        <h3 class="birthday-heading">Today's Birthdays</h3>
                        <ul class="birthday-list">
                            @foreach($todaysBirthdays->where('employee_status', 'Active') as $employee)
                                <li class="birthday-item">{{ $employee->first_name }} {{ $employee->last_name }}</li>
                            @endforeach
                        </ul>
                    @endif

                    @if($upcomingBirthdays->where('employee_status', 'Active')->isNotEmpty())
                        <h3 class="birthday-heading">Upcoming Birthdays This Month</h3>
                        <ul class="birthday-list">
                            @foreach($upcomingBirthdays->where('employee_status', 'Active') as $employee)
                                <li class="birthday-item">
                                    {{ $employee->first_name }} {{ $employee->last_name }} -
                                    {{ \Carbon\Carbon::parse($employee->birth_date)->format('F d') }}
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-muted">No upcoming birthdays this month</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Holidays of the Month section -->
        <div class="col-lg-6 mb-4">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-calendar-alt mr-2"></i>Holidays in {{ $currentMonthName }}</h5>
                </div>
                <div class="card-body">
                    @if ($todayHoliday)
                        <p>Today is <strong class="text-danger">{{ $todayHoliday->title }}</strong> - {{ \Carbon\Carbon::parse($todayHoliday->date)->format('F j, Y') }}</p>
                    @endif
                    @if ($upcomingHolidays->isEmpty())
                        <p class="text-muted">No upcoming holidays this month</p>
                    @else
                        <ul class="custom-list">
                            @foreach ($upcomingHolidays as $holiday)
                                <li>
                                    <strong class="text-danger">{{ $holiday->title }}</strong> -
                                    {{ \Carbon\Carbon::parse($holiday->date)->format('F j, Y') }}
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Admin dashboard section -->
    @canany(['super-admin', 'admin', 'hrcomben', 'hrcompliance'])
        <div class="row">
            @php
                $dashboardItems = [
                    ['icon' => 'fas fa-users', 'title' => 'Users', 'count' => $userCount, 'bg' => 'bg-info'],
                    ['icon' => 'fas fa-user-tie', 'title' => 'Employees', 'count' => $employeeCount, 'bg' => 'bg-primary'],
                    ['icon' => 'fas fa-calendar-check', 'title' => 'All Attended', 'count' => $attendanceAllCount, 'bg' => 'bg-purple'],
                    ['icon' => 'fas fa-calendar-check', 'title' => 'Attended Today', 'count' => $attendanceCount, 'bg' => 'bg-success'],
                ];
            @endphp

            @foreach($dashboardItems as $item)
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="card dashboard-card {{ $item['bg'] }} text-white">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <i class="{{ $item['icon'] }} card-icon"></i>
                                <div>
                                    <h6 class="card-title mb-0">{{ $item['title'] }}</h6>
                                    <h2 class="card-text mb-0">{{ $item['count'] }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Leave section -->
        <div class="row">
            @php
                $leaveItems = [
                    ['icon' => 'fas fa-sign-out-alt', 'title' => 'All Leaves', 'count' => $leaveCount, 'bg' => 'bg-primary'],
                    ['icon' => 'fas fa-check', 'title' => 'Approved Leaves', 'count' => $approvedLeavesCount, 'bg' => 'bg-success'],
                    ['icon' => 'fas fa-hourglass-half', 'title' => 'Pending Leaves', 'count' => $pendingLeavesCount, 'bg' => 'bg-warning'],
                    ['icon' => 'fas fa-times', 'title' => 'Rejected Leaves', 'count' => $rejectedLeavesCount, 'bg' => 'bg-danger'],
                ];
            @endphp

            @foreach($leaveItems as $item)
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="card {{ $item['bg'] }} text-white">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <i class="{{ $item['icon'] }} card-icon"></i>
                                <div>
                                    <h6 class="card-title mb-0">{{ $item['title'] }}</h6>
                                    <h2 class="card-text mb-0">{{ $item['count'] }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            @endcanany
            @can('hrhiring')
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="card bg-info text-white">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-user-tie card-icon"></i>
                                <div>
                                    <h6 class="card-title mb-0">Applicant</h6>
                                    <h2 class="card-text mb-0">{{ $careerCount }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endcan
        </div>
</div>

<script>
    (function() {
        function updateClock() {
            const now = new Date();
            updateClockDisplay(now);
            setTimeout(updateClock, 1000);
        }

        function updateClockDisplay(dateTime) {
            const clock = document.getElementById('clock');
            const dateElement = document.getElementById('date');

            if (!clock || !dateElement) return;

            try {
                // Format time: 12:34:56 PM
                const timeOptions = {
                    hour: 'numeric',
                    minute: '2-digit',
                    second: '2-digit',
                    hour12: true,
                    timeZone: 'Asia/Manila'
                };

                // Format date: Monday, January 1, 2024
                const dateOptions = {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric',
                    timeZone: 'Asia/Manila'
                };

                clock.textContent = dateTime.toLocaleTimeString('en-US', timeOptions);
                dateElement.textContent = dateTime.toLocaleDateString('en-US', dateOptions);
            } catch (error) {
                console.error('Error updating clock display:', error);
                // Fallback to basic format if there's an error
                clock.textContent = dateTime.toLocaleTimeString('en-US');
                dateElement.textContent = dateTime.toLocaleDateString('en-US');
            }
        }

        // Start the clock
        updateClock();
    })();

    // Add smooth scrolling
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });

    // Add animation to cards on scroll
    const cards = document.querySelectorAll('.card');
    const animateCards = () => {
        cards.forEach(card => {
            const cardTop = card.getBoundingClientRect().top;
            const triggerBottom = window.innerHeight / 5 * 4;
            if(cardTop < triggerBottom) {
                card.classList.add('show');
            } else {
                card.classList.remove('show');
            }
        });
    }
    window.addEventListener('scroll', animateCards);
</script>

<!-- Analytics Dashboard -->
@canany(['super-admin', 'admin'])
<div class="analytics-dashboard mt-4">
    <h4 class="text-center mb-4">Analytics Overview</h4>

    <!-- Contributions Section -->
    <div class="analytics-section">
        <div class="section-header">
            <i class="fas fa-chart-line"></i>
            <h5>Contribution Analytics</h5>
        </div>
        <div class="row">
            @php
                $contributionItems = [
                    [
                        'title' => 'SSS Contributions',
                        'icon' => 'fas fa-shield-alt',
                        'color' => 'primary',
                        'total' => $analytics['sss']['total_contributions'],
                        'count' => $analytics['sss']['contribution_count'],
                        'chartId' => 'sssChart',
                        'data' => $analytics['sss']['monthly_trend']
                    ],
                    [
                        'title' => 'Pagibig Contributions',
                        'icon' => 'fas fa-home',
                        'color' => 'success',
                        'total' => $analytics['pagibig']['total_contributions'],
                        'count' => $analytics['pagibig']['contribution_count'],
                        'chartId' => 'pagibigChart',
                        'data' => $analytics['pagibig']['monthly_trend']
                    ],
                    [
                        'title' => 'Philhealth Contributions',
                        'icon' => 'fas fa-heartbeat',
                        'color' => 'danger',
                        'total' => $analytics['philhealth']['total_contributions'],
                        'count' => $analytics['philhealth']['contribution_count'],
                        'chartId' => 'philhealthChart',
                        'data' => $analytics['philhealth']['monthly_trend']
                    ],
                ];
            @endphp

            @foreach($contributionItems as $item)
            <div class="col-md-4 mb-4">
                <div class="analytics-card">
                    <div class="analytics-title">
                        <i class="{{ $item['icon'] }} text-{{ $item['color'] }}"></i>
                        {{ $item['title'] }}
                    </div>
                    <div class="analytics-content">
                        <div class="analytics-metric">
                            <span class="analytics-label">Total Contributions</span>
                            <span class="analytics-number">₱{{ number_format($item['total'], 2) }}</span>
                        </div>
                        <div class="chart-container">
                            <canvas id="{{ $item['chartId'] }}"></canvas>
                        </div>
                        <div class="trend-info">
                            <i class="fas fa-info-circle"></i>
                            Monthly Trend - {{ $item['count'] }} contributions
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Loans Section -->
    <div class="analytics-section">
        <div class="section-header">
            <i class="fas fa-money-bill-wave"></i>
            <h5>Loan Analytics</h5>
        </div>
        <div class="row">
            @php
                $loanItems = [
                    [
                        'title' => 'SSS Loans',
                        'icon' => 'fas fa-money-bill-wave',
                        'color' => 'warning',
                        'total' => $analytics['loans']['sss_loans']['total_amount'],
                        'count' => $analytics['loans']['sss_loans']['loan_count'],
                        'chartId' => 'sssLoanChart',
                        'data' => $analytics['loans']['sss_loans']['monthly_trend'] ?? []
                    ],
                    [
                        'title' => 'Pagibig Loans',
                        'icon' => 'fas fa-hand-holding-usd',
                        'color' => 'info',
                        'total' => $analytics['loans']['pagibig_loans']['total_amount'],
                        'count' => $analytics['loans']['pagibig_loans']['loan_count'],
                        'chartId' => 'pagibigLoanChart',
                        'data' => $analytics['loans']['pagibig_loans']['monthly_trend'] ?? []
                    ],
                    [
                        'title' => 'Cash Advances',
                        'icon' => 'fas fa-hand-holding-usd',
                        'color' => 'secondary',
                        'total' => $analytics['loans']['cash_advances']['total_amount'],
                        'count' => $analytics['loans']['cash_advances']['advance_count'],
                        'chartId' => 'cashAdvanceChart',
                        'data' => $analytics['loans']['cash_advances']['monthly_trend'] ?? []
                    ],
                ];
            @endphp

            @foreach($loanItems as $item)
            <div class="col-md-4 mb-4">
                <div class="analytics-card">
                    <div class="analytics-title">
                        <i class="{{ $item['icon'] }} text-{{ $item['color'] }}"></i>
                        {{ $item['title'] }}
                    </div>
                    <div class="analytics-content">
                        <div class="analytics-metric">
                            <span class="analytics-label">Total Amount</span>
                            <span class="analytics-number">₱{{ number_format($item['total'], 2) }}</span>
                        </div>
                        <div class="chart-container">
                            <canvas id="{{ $item['chartId'] }}"></canvas>
                        </div>
                        <div class="trend-info">
                            <i class="fas fa-info-circle"></i>
                            Monthly Trend - {{ $item['count'] }} active
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endcanany

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    function createLineChart(elementId, label, data, color) {
        const ctx = document.getElementById(elementId).getContext('2d');
        const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: months,
                datasets: [{
                    label: label,
                    data: data,
                    borderColor: color,
                    backgroundColor: color + '20', // Add transparency to background
                    fill: true,
                    tension: 0.4,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    pointBackgroundColor: color,
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                        callbacks: {
                            label: function(context) {
                                return '₱' + context.raw.toLocaleString();
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return '₱' + value.toLocaleString();
                            }
                        }
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index'
                }
            }
        });
    }

    // Create charts when the page loads
    document.addEventListener('DOMContentLoaded', function() {
        // Contribution Charts
        createLineChart('sssChart', 'SSS Contributions', @json($analytics['sss']['monthly_trend']), '#0d6efd');
        createLineChart('pagibigChart', 'Pagibig Contributions', @json($analytics['pagibig']['monthly_trend']), '#198754');
        createLineChart('philhealthChart', 'Philhealth Contributions', @json($analytics['philhealth']['monthly_trend']), '#dc3545');

        // Loan Charts
        createLineChart('sssLoanChart', 'SSS Loans', @json($analytics['loans']['sss_loans']['monthly_trend'] ?? []), '#ffc107');
        createLineChart('pagibigLoanChart', 'Pagibig Loans', @json($analytics['loans']['pagibig_loans']['monthly_trend'] ?? []), '#0dcaf0');
        createLineChart('cashAdvanceChart', 'Cash Advances', @json($analytics['loans']['cash_advances']['monthly_trend'] ?? []), '#6c757d');
    });
</script>
@endsection

<script>
    let animationFrameId = null; // Store the animation frame ID
    
    function stopBalloons() {
        // Cancel the animation frame
        if (animationFrameId) {
            cancelAnimationFrame(animationFrameId);
            animationFrameId = null;
        }

        // Remove the canvas
        const canvas = document.getElementById('balloon-canvas');
        if (canvas) {
            canvas.remove();
        }

        // Reset score if needed
        const scoreDisplay = document.getElementById('balloon-score');
        if (scoreDisplay) {
            scoreDisplay.textContent = '0';
        }
    }

    function startBalloons() {
        // Clean up any existing canvas first
        stopBalloons();

        const canvas = document.createElement('canvas');
        canvas.id = 'balloon-canvas';
        document.body.insertBefore(canvas, document.body.firstChild);

        const ctx = canvas.getContext('2d');
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;

        const colors = ['#FF6B6B', '#4ECDC4', '#45B7D1', '#96CEB4', '#FFEEAD', '#FFD93D', '#FF9999', '#A8E6CF'];
        let selectedBalloon = null;
        let isDragging = false;
        let dragOffsetX = 0;
        let dragOffsetY = 0;
        let dart = null;
        let particles = [];

        class Dart {
            constructor(x, y, targetX, targetY) {
                this.x = x;
                this.y = y;
                const angle = Math.atan2(targetY - y, targetX - x);
                this.dx = Math.cos(angle) * 15;
                this.dy = Math.sin(angle) * 15;
                this.size = 15;
            }

            draw() {
                ctx.save();
                ctx.translate(this.x, this.y);
                ctx.rotate(Math.atan2(this.dy, this.dx));
                
                // Draw dart
                ctx.beginPath();
                ctx.moveTo(0, 0);
                ctx.lineTo(-this.size, -this.size/4);
                ctx.lineTo(-this.size, this.size/4);
                ctx.fillStyle = '#333';
                ctx.fill();
                
                ctx.restore();
            }

            update() {
                this.x += this.dx;
                this.y += this.dy;
            }
        }

        class Particle {
            constructor(x, y, color) {
                this.x = x;
                this.y = y;
                this.color = color;
                this.size = Math.random() * 4 + 2;
                this.speedX = Math.random() * 6 - 3;
                this.speedY = Math.random() * 6 - 3;
                this.lifetime = 1;
            }

            draw() {
                ctx.beginPath();
                ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
                ctx.fillStyle = this.color;
                ctx.globalAlpha = this.lifetime;
                ctx.fill();
                ctx.globalAlpha = 1;
            }

            update() {
                this.x += this.speedX;
                this.y += this.speedY;
                this.speedY += 0.1; // Gravity
                this.lifetime -= 0.02;
            }
        }

        class Balloon {
            constructor() {
                this.reset();
                this.y = canvas.height + 50;
                this.wobble = 0;
                this.wobbleSpeed = Math.random() * 0.03 + 0.02;
                this.size = Math.random() * 30 + 40;
                this.popped = false;
                this.clickCount = 0;
                this.lastClickTime = 0;
                this.points = Math.floor(Math.random() * 5) + 1; // Random points 1-5
            }

            reset() {
                this.x = Math.random() * canvas.width;
                this.y = canvas.height + 50;
                this.color = colors[Math.floor(Math.random() * colors.length)];
                this.speed = Math.random() * 2 + 1;
                this.angle = 0;
            }

            draw() {
                if (this.popped) return;

                ctx.save();
                ctx.translate(this.x, this.y);
                
                this.wobble += this.wobbleSpeed;
                ctx.rotate(Math.sin(this.wobble) * 0.1);

                // Balloon body
                ctx.beginPath();
                ctx.moveTo(0, 0);
                ctx.bezierCurveTo(
                    this.size/2, -this.size/2,
                    this.size/2, -this.size,
                    0, -this.size
                );
                ctx.bezierCurveTo(
                    -this.size/2, -this.size,
                    -this.size/2, -this.size/2,
                    0, 0
                );

                const gradient = ctx.createRadialGradient(
                    -this.size/4, -this.size/2, 0,
                    -this.size/4, -this.size/2, this.size
                );
                gradient.addColorStop(0, 'white');
                gradient.addColorStop(0.5, this.color);
                gradient.addColorStop(1, this.color);
                
                ctx.fillStyle = gradient;
                ctx.fill();

                // Shine
                ctx.beginPath();
                ctx.ellipse(
                    -this.size/4, -this.size/2,
                    this.size/6, this.size/4,
                    Math.PI/4, 0, 2 * Math.PI
                );
                ctx.fillStyle = 'rgba(255, 255, 255, 0.2)';
                ctx.fill();

                // String
                ctx.beginPath();
                ctx.moveTo(0, 0);
                ctx.quadraticCurveTo(5, 10, 0, 20);
                ctx.strokeStyle = '#999';
                ctx.lineWidth = 1.5;
                ctx.stroke();

                ctx.restore();
            }

            update() {
                if (!this.popped) {
                    if (!isDragging || this !== selectedBalloon) {
                        this.y -= this.speed;
                        if (this.y < -this.size * 2) {
                            this.reset();
                        }
                    }
                }
            }

            contains(x, y) {
                const dx = x - this.x;
                const dy = y - (this.y - this.size/2);
                return (dx * dx + dy * dy) < (this.size * this.size);
            }

            pop() {
                if (!this.popped) {
                    this.popped = true;
                    // Create explosion particles
                    for (let i = 0; i < 20; i++) {
                        particles.push(new Particle(this.x, this.y, this.color));
                    }
                }
            }

            // Add double-click detection
            handleClick(time) {
                if (this.popped) return;
                
                if (time - this.lastClickTime < 300) { // 300ms double-click threshold
                    this.pop();
                    score += this.points;
                    if (scoreDisplay) {
                        scoreDisplay.textContent = score;
                        
                        // Add score animation
                        const pointsPopup = document.createElement('div');
                        pointsPopup.className = 'points-popup';
                        pointsPopup.textContent = `+${this.points}`;
                        pointsPopup.style.position = 'absolute';
                        pointsPopup.style.left = `${this.x}px`;
                        pointsPopup.style.top = `${this.y}px`;
                        document.body.appendChild(pointsPopup);
                        
                        setTimeout(() => pointsPopup.remove(), 1000);
                    }
                }
                this.lastClickTime = time;
            }
        }

        const balloons = Array.from({ length: 15 }, () => new Balloon());

        function animate() {
            if (!document.getElementById('balloon-canvas')) return;
            
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            
            // Update and draw balloons
            balloons.forEach(balloon => {
                balloon.update();
                balloon.draw();
            });

            // Update and draw particles
            particles = particles.filter(particle => particle.lifetime > 0);
            particles.forEach(particle => {
                particle.update();
                particle.draw();
            });
            
            // Store the animation frame ID so we can cancel it later
            animationFrameId = requestAnimationFrame(animate);
        }

        animate();
    }

    // Update modal event handlers
    document.addEventListener('DOMContentLoaded', function() {
        const todaysBirthdaysCount = {{ $todaysBirthdays->where('employee_status', 'Active')->count() }};
        let currentModalIndex = 0;
        let modalShown = false;

        // Function to generate a unique key for localStorage
        function getBirthdayKey(employeeId) {
            return `birthday_modal_${employeeId}_dont_show`;
        }

        // Function to check if modal should be shown
        function shouldShowModal(employeeId) {
            const key = getBirthdayKey(employeeId);
            return !localStorage.getItem(key);
        }

        // Function to mark modal as permanently hidden
        function markModalAsHidden(employeeId) {
            const key = getBirthdayKey(employeeId);
            localStorage.setItem(key, 'hidden');
        }

        // Function to show next birthday modal
        function showNextBirthdayModal() {
            if (currentModalIndex < todaysBirthdaysCount && !modalShown) {
                const modalElement = document.querySelector(`#birthdayModal${currentModalIndex}`);
                if (!modalElement) return;

                const checkbox = modalElement.querySelector('.dont-show-checkbox');
                const employeeId = checkbox.dataset.employeeId;

                // Check if the modal should be shown
                if (shouldShowModal(employeeId)) {
                    modalShown = true;
                    $(modalElement).modal('show');

                    // Start balloons when modal is shown
                    $(modalElement).on('shown.bs.modal', function() {
                        startBalloons();
                        
                        // Check if the modal was previously hidden
                        const isHidden = localStorage.getItem(getBirthdayKey(employeeId));
                        if (isHidden) {
                            checkbox.checked = true;
                        }
                    });

                    // When current modal is hidden
                    $(modalElement).on('hidden.bs.modal', function() {
                        stopBalloons();
                        modalShown = false;
                        currentModalIndex++;
                        setTimeout(showNextBirthdayModal, 500);
                    });
                } else {
                    currentModalIndex++;
                    showNextBirthdayModal();
                }
            }
        }

        // Handle checkbox changes
        document.querySelectorAll('.dont-show-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const employeeId = this.dataset.employeeId;
                
                if (this.checked) {
                    // Mark modal as permanently hidden
                    markModalAsHidden(employeeId);
                    
                    // Show confirmation message
                    const confirmMessage = document.createElement('div');
                    confirmMessage.className = 'alert alert-info mt-2';
                    confirmMessage.textContent = 'This birthday modal will not be shown again.';
                    this.closest('.dont-show-again').appendChild(confirmMessage);
                    
                    // Remove confirmation message after 3 seconds
                    setTimeout(() => {
                        confirmMessage.remove();
                    }, 3000);
                } else {
                    // Remove the hidden status if unchecked
                    localStorage.removeItem(getBirthdayKey(employeeId));
                }
            });
        });

        // Function to check localStorage status on page load
        function initializeCheckboxes() {
            document.querySelectorAll('.dont-show-checkbox').forEach(checkbox => {
                const employeeId = checkbox.dataset.employeeId;
                const isHidden = localStorage.getItem(getBirthdayKey(employeeId));
                checkbox.checked = !!isHidden;
            });
        }

        // Initialize checkboxes
        initializeCheckboxes();

        // Start showing modals after a short delay
        setTimeout(showNextBirthdayModal, 1000);
    });

    // Function to check if user has logged in today
    function hasLoggedInToday() {
        const today = new Date().toDateString();
        return localStorage.getItem('last_login_date') === today;
    }

    // Function to mark today's login
    function markTodayLogin() {
        const today = new Date().toDateString();
        localStorage.setItem('last_login_date', today);
    }
</script>
@endsection