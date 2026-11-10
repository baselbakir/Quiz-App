@extends('layouts.app')

@section('content')

<style>
    /* تزيين الخلفية مع تأثير حركة */
    .hero-section {
        background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('/images/dark-bg.jpg') no-repeat center center fixed;
        background-size: cover;
        height: 100vh;
        color: #fff;
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
        flex-direction: column;
        animation: backgroundAnimation 10s infinite alternate;
    }

    /* تأثير الحركة الخلفية */
    @keyframes backgroundAnimation {
        0% {
            background-position: 0% 0%;
        }
        50% {
            background-position: 100% 0%;
        }
        100% {
            background-position: 0% 100%;
        }
    }

    /* تنسيق النص */
    .hero-title {
        font-size: 3.5rem;
        font-weight: bold;
        margin-bottom: 30px;
        text-shadow: 3px 3px 8px rgba(0, 0, 0, 0.7);
        animation: textFadeIn 2s ease-out;
    }

    /* تأثير ظهور النص */
    @keyframes textFadeIn {
        0% {
            opacity: 0;
            transform: translateY(-20px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* تنسيق الزر */
    .hero-button {
        padding: 15px 35px;
        font-size: 1.2rem;
        font-weight: 500;
        border-radius: 40px;
        border: none;
        background-color: #28a745;
        color: #fff;
        transition: background-color 0.3s ease, transform 0.2s ease;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.4);
        animation: buttonPulse 2s infinite ease-in-out;
    }

    /* تأثير الحركة للزر */
    @keyframes buttonPulse {
        0% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.1);
        }
        100% {
            transform: scale(1);
        }
    }

    /* تأثير hover للزر */
    .hero-button:hover {
        background-color: #218838;
        color: #fff;
        transform: scale(1.1);
    }
</style>

<div class="hero-section">
    <h1 class="hero-title">🎓 مرحباً بك في منصة الامتحانات</h1>
    <a href="{{ url('/exams') }}" class="hero-button">دخول إلى الامتحانات</a>
</div>

@endsection
